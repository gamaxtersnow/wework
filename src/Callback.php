<?php
namespace WeWork;
use Exception;
use SimpleXMLElement;
use Symfony\Component\HttpFoundation\Request;
use WeWork\Crypt\WXBizMsgCrypt;
use WeWork\Message\ReplyMessageInterface;

class Callback {
    protected $request;
    protected $crypt;
    protected $content = null;
    public function __construct(Request $request, WXBizMsgCrypt $crypt)
    {
        $this->request = $request;
        $this->crypt = $crypt;
    }
    /**
     * @throws Exception
     */
    public function getContent()
    {
        if($this->content===null) {
            if (!$this->request->getContent()) {
                return null;
            }
            $data = '';
            $this->crypt->DecryptMsg(
                $this->request->query->get('msg_signature'),
                $this->request->query->get('timestamp'),
                $this->request->query->get('nonce'),
                $this->request->getContent(),
                $data
            );
            $this->content = $data;
            $this->setRequestAttribute($this->content);
        }
        return $this->content;
    }
    /**
     * @throws Exception
     */
    public function get(string $key)
    {
        if (!$this->request->getContent()) {
            return '';
        }
        if (!$this->request->attributes->has($key)) {
            $this->getContent();
        }
        return $this->request->attributes->get($key);
    }
    /**
     * @param ReplyMessageInterface $replyMessage
     * @return string
     */
    public function reply(ReplyMessageInterface $replyMessage): string
    {
        if ($this->request->query->has('echostr')) {
            return $this->decryptEchoStr();
        }
        return $this->encryptReply($this->buildReply($replyMessage));

    }
    public function echoStr(): string
    {
        if ($this->request->query->has('echostr')) {
            return $this->decryptEchoStr();
        }
        return '';
    }
    public function xmlToJson(string $xml):string{
        return json_encode(simplexml_load_string($xml,'SimpleXMLElement',LIBXML_NOCDATA));
    }
    public function xmlToArray(string $xml):array{
        return json_decode($this->xmlToJson($xml),true);
    }
    /**
     * @param string $data
     * @return void
     * @throws Exception
     */
    protected function setRequestAttribute(string $data){
        if ($data) {
            $xml = new SimpleXMLElement($data);
            foreach ($xml as $key => $value) {
                $this->request->attributes->set("$key", "$value");
            }
        }
    }
    protected function decryptEchoStr(): string
    {
        $plainText = '';

        $this->crypt->VerifyURL(
            $this->request->query->get('msg_signature'),
            $this->request->query->get('timestamp'),
            $this->request->query->get('nonce'),
            $this->request->query->get('echostr'),
            $plainText
        );

        return $plainText;
    }
    protected function encryptReply(string $reply): string
    {
        $cipherText = '';

        $this->crypt->EncryptMsg(
            $reply,
            $this->request->query->get('timestamp'),
            $this->request->query->get('nonce'),
            $cipherText
        );

        return $cipherText;
    }
    protected function buildReply(ReplyMessageInterface $replyMessage): string
    {
        $reply = $replyMessage->formatForReply();

        $reply['ToUserName'] = $this->request->attributes->get('FromUserName');
        $reply['FromUserName'] = $this->request->attributes->get('ToUserName');
        $reply['CreateTime'] = (int)$this->request->attributes->get('CreateTime');

        $element = new SimpleXMLElement('<xml/>');

        $this->arrayToXml($reply, $element);

        $dom = dom_import_simplexml($element);

        return $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
    }
    protected function arrayToXml(array $data, SimpleXMLElement &$element): void
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item';
            }

            if (is_array($value)) {
                $subNode = $element->addChild($key);
                $this->arrayToXml($value, $subNode);
            } elseif (is_string($value)) {
                $node = dom_import_simplexml($element->addChild($key));
                $no = $node->ownerDocument;
                $node->appendChild($no->createCDATASection($value));
            } else {
                $element->addChild($key, $value);
            }
        }
    }

}