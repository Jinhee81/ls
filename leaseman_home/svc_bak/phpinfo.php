<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$c = new TaxinvoiceDetail();

class TaxinvoiceDetail
{
    public $serialNum;
    public $purchaseDT;
    public $itemName;
    public $spec;
    public $qty;
    public $unitCost;
    public $supplyCost;
    public $tax;
    public $remark;

    public function fromJsonInfo($jsonInfo)
    {
        isset($jsonInfo->serialNum) ? $this->serialNum = $jsonInfo->serialNum : null;
        isset($jsonInfo->purchaseDT) ? $this->purchaseDT = $jsonInfo->purchaseDT : null;
        isset($jsonInfo->itemName) ? $this->itemName = $jsonInfo->itemName : null;
        isset($jsonInfo->spec) ? $this->spec = $jsonInfo->spec : null;
        isset($jsonInfo->qty) ? $this->qty = $jsonInfo->qty : null;
        isset($jsonInfo->unitCost) ? $this->unitCost = $jsonInfo->unitCost : null;
        isset($jsonInfo->supplyCost) ? $this->supplyCost = $jsonInfo->supplyCost : null;
        isset($jsonInfo->tax) ? $this->tax = $jsonInfo->tax : null;
        isset($jsonInfo->remark) ? $this->remark = $jsonInfo->remark : null;
    }
}
?>
