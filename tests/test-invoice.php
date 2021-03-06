<?php

use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase {
    
    public function testInvoiceMapperRespondsWithInvoiceEntity() {
        
        $responseXML = '<?xml version="1.0"?>
            <salesinvoice result="1">
                <header>
                    <office>11024</office>
                    <invoicetype>FACTUUR</invoicetype>
                    <invoicenumber>5</invoicenumber>
                    <invoicedate>20120831</invoicedate>
                    <duedate>20120930</duedate>
                    <bank>BNK</bank>
                    <invoiceaddressnumber>1</invoiceaddressnumber>
                    <deliveraddressnumber>1</deliveraddressnumber>
                    <customer>1000</customer>
                    <period>2012/8</period>
                    <currency>EUR</currency>
                    <status>concept</status>
                    <paymentmethod>cash</paymentmethod>
                    <headertext/>
                    <footertext/>
                </header>
                <lines>
                    <line id="1">
                        <article>4</article>
                        <subarticle>118</subarticle>
                        <quantity>1</quantity>
                        <units>1</units>
                        <allowdiscountorpremium>true</allowdiscountorpremium>
                        <description>CoalesceFunctioningOnImpatienceTShirt</description>
                        <valueexcl>15.00</valueexcl>
                        <vatvalue>0.00</vatvalue>
                        <valueinc>15.00</valueinc>
                        <unitspriceexcl>15.00</unitspriceexcl>
                        <freetext1/>
                        <freetext2/>
                        <freetext3/>
                        <dim1>8020</dim1>
                        <vatcode name="BTW 0%" shortname="V 0%" type="sales">VN</vatcode>
                    </line>
                </lines>
                <vatlines>
                    <vatline>
                        <vatcode name="BTW 0%">VN</vatcode>
                        <vatvalue>0.00</vatvalue>
                        <performancetype/><performancedate/>
                    </vatline>
                </vatlines>
                <totals>
                    <valueinc>15.00</valueinc>
                    <valueexcl>15.00</valueexcl>
                </totals>
            </salesinvoice>';
        
        $responseDocument = new DOMDocument();
        $responseDocument->loadXML($responseXML);
        
        $invoice_response = new \Pronamic\Twinfield\Response\Response($responseDocument);
        $invoice = Pronamic\Twinfield\Invoice\Mapper\InvoiceMapper::map($invoice_response);
        
        $this->assertTrue($invoice instanceof \Pronamic\Twinfield\Invoice\Invoice);
        
    }
}