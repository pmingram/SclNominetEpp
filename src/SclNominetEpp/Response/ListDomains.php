<?php

namespace SclNominetEpp\Response;

use SclNominetEpp\Response;

/**
 * This class interprets XML for a Nominet EPP list command response.
 *
 * @author Merlyn Cooper <merlyn.cooper@hotmail.co.uk>
 */
class ListDomains extends Response
{
    //put your code here
    protected $domains = array();

    /**
     * @todo Tom, what's the return type?
     * @param \SimpleXMLElement $xml
     * @return mixed
     */
    protected function processData(SimpleXMLElement $xml)
    {
        if (!$this->xmlValid($xml->response->resData)) {
            return;
        }
        
        $ns = $xml->getNamespaces(true);

        $domains = $xml->response->resData->children($ns['list'])->listData;

        $this->domains = array();

        foreach ($domains->domainName as $domain) {
            $this->domains[] = (string) $domain;
        }
    }

    /**
     * 
     * @param \SimpleXMLElement $xml
     * @return boolean
     */
    public function xmlValid(SimpleXMLElement $xml)
    {
        return isset($xml);
    }
    
    /**
     * 
     * @return array
     */
    public function getDomains()
    {
        return $this->domains;
    }
}
