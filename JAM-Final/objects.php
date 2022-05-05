<?php

// Card object => Used to create object that can pass parameters to the api
class Card
{
    protected $sourceID;
    protected $referenceID;
    protected $customerID;
    protected $indepodenceyKey;
    protected $firstName;
    protected $lastName;
    protected $lastFour;
    protected $cardBrand;
    protected $month;
    protected $year;
    //BillingAddress object
    protected $addressToken;

    public function __construct($sourceID, $referenceID, $customerID, $indepodenceyKey, $firstName, $lastName, $lastFour, $cardBrand, $month, $year, $addressToken)
    {
        $this->sourceID = $sourceID;
        $this->referenceID = $referenceID;
        $this->customerID = $customerID;
        $this->indepodenceyKey = $indepodenceyKey;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->lastFour = $lastFour;
        $this->cardBrand = $cardBrand;
        $this->month = $month;
        $this->year = $year;
        $this->addressToken = $addressToken;
    }

    // Getters
        function getSourceID() : int {return $sourceID;}
        function getReferenceID() : int {return $referenceID;}
        function getCustomerID() : int {return $customerID;}
        function getIndepodenceyKey() : string {return $indepodenceyKey;}
        function getfirstName() : string {return $firstName;}
        function getCardBrand() : string {return $cardBrand;}
        function getLastName() : string {return $lastName;}
        function getLastFour() : int {return $lastFour;}
        function getMonth() : int {return $month;}
        function getYear() : int {return $year;}
        function getAddressToken() : BillingAddress {return $addressToken;}
    // Setters
        function setSourceID($sourceID) {$this->sourceID = $sourceID;}
        function setReferenceID($referenceID)  {$this->referenceID = $referenceID;}
        function setCustomerID($customerID) {$this->customerID = $customerID;}
        function setIndepodenceyKey($indepodenceyKey) {$this->indepodenceyKey = $indepodenceyKey;}
        function setfirstName($firstName) {$this->firstName = $firstName;}
        function setCardBrand($cardBrand) {$this->cardBrand = $cardBrand;}
        function setLastName($lastName) {$this->lastName = $lastName;}
        function setLastFour($lastFour) {$this->lastFour = $lastFour;}
        function setMonth($month) {$this->month = $month;}
        function setYear($year) {$this->year = $year;}
        function setAddressToken($addressToken) {$this->addressToken = $addressToken;}


}
//BillingAddress object => Used in Card Creation, but parameter reduction in the Card constructor is always welcome

class BillingAddress
{
        protected $lineOne;
        protected $lineTwo;
        protected $lineThree;
        protected $state;
        protected $city;
        protected $zipCode;
        protected $country;

        public function __construct($lineOne, $lineTwo, $lineThree, $state, $city, $zipCode, $country)
        {
            $this->lineOne = $lineOne;
            $this->lineTwo = $lineTwo;
            $this->lineThree = $lineThree;
            $this->state = $state;
            $this->city = $city;
            $this->zipCode = $zipCode;
            $this->country = $country;
        }
        // Getters
            function getLineOne() : string {return $lineOne;}
            function getLineTwo() : string {return $lineTwo;}
            function getLineThree() : string {return $lineThree;}
            function getState() : string {return $state;}
            function getZipCode() : int{return $zipCode;}
            function getCity() : string{return $city;}
            function getCountry() : string{return $country;}
        // Setters
            function setLineOne($lineOne){$this->lineOne = $lineOne;}
            function setLineTwo(){$this->lineTwo = $lineTwo;}
            function setLineThree($lineThree){$this->lineThree = $lineThree;}
            function setState($state){$this->state = $state; }
            function setZipCode(){$this->zipCode = $zipCode;}
            function setCity(){$this->city = $city;}
            function setCountry(){$this->country = $country;}
}
// Payment object => Used to create object that can pass parameters to the api
class Payment
{

    protected $sourceID;
    protected $referenceID;
    protected $customerID;
    protected $indepodenceyKey;
    protected $orderID;
    protected $amount;
    protected $appFee;
    protected $tipAmount;


    public function __construct($sourceID, $referenceID, $customerID, $indepodenceyKey, $orderID, $amount, $appFee, $tipAmount)
    {
        $this->sourceID = $sourceID;
        $this->referenceID = $referenceID;
        $this->customerID = $customerID;
        $this->indepodenceyKey = $indepodenceyKey;
        $this->orderID = $orderID;
        $this->amount = $amount;
        $this->appFee = $appFee;
        $this->$tipAmount = $tipAmount;
    }

    // Getters
        function getSourceID() : int {return $sourceID;}
        function getReferenceID() : int {return $referenceID;}
        function getCustomerID() : int {return $customerID;}
        function getIndepodenceyKey() : string{return $indepodenceyKey;}
        function getOrderID() : int {return $orderID;}
        function getAmount() : double {return $amount;}
        function getAppFee() : double {return $appFee;}
        function getTipAmount() : double {return $tipAmount;}

    // Setters
        function setSourceID($sourceID){$this->sourceID = $sourceID;}
        function setReferenceID(){$this->referenceID = $referenceID;}
        function setCustomerID(){$this->customerID = $customerID;}
        function setIndepodenceyKey(){$this->indepodenceyKey = $indepodenceyKey;}
        function setOrderID(){$this->orderID = $orderID;}
        function setAmount(){$this->amount = $amount;}
        function setAppFee(){$this->appFee = $appFee;}
        function setTipAmount(){$this->tipAmount = $tipAmount;}



}

// EventHandler object => in charge of coordinating events and responses on the site

class EventHandler
{
    protected $websiteData = [];

    public function __construct()
    {
    }
    function createEvent($eventType) : Event {}
    function createResponse($eventType) : Response {}
}

// EventType Enum => Groups data types for event handler
enum EventType {

    case Transaction;
    case Account;
    case Item;
    case Error;
    case Response;

}

//Event Object => All interactions between users of the site and the back-end involved will happen through these objects

class Event
{
    protected $eventType;
    protected $eventID = 0;
    public function __construct($eventType)
    {
        $this->eventType = $eventType;
        $eventID++;
    }

}

class Response
{

    protected $eventType;
    protected $responseID = 0;

    public function __construct($eventType)
    {
        $this->eventType = EventType($eventType);
        $responseID++;

        switch($eventType)

            case EventType::Transaction:
                promptTransaction();
                break;
            case EventType::Account:
                promptAccountRegistration();
                break;
            case EventType::Item:
                promptItemCreation();
                break;
            case EventType::Error:
                promptError();
                break;
    }
    // prompt object creation (passed off to builder objects)
    function promptTransaction(){}
    function promptAccountRegistration(){}
    function promptItemCreation(){}
    function promptError(){}

}

class TransactionBuilder
{
    protected $transactionCount = 0;
    public function __construct()
    {
        $transactionCount++;
    }
    function createTransaction() : Transaction {}
    function getCount()
    {
        return $transactionCount;
    }
}

class Transaction
{
    public function __construct(){}
    function promptCard() : array {}
    function createCard() : Card {}
    function createPayment() : Payment {}
    function listPayments() : array {}
    function updatePayment() : array {}
    function completePayment() : bool {}
}

class AccountBuilder
    {
        protected $accountCount = 0;
        public function __construct()
        {
            $accountCount++;
        }
        function createAccount() : Account {}
        function getCount()
           {
               return $accountCount;
           }
    }

class Account
    {
       public function __construct(){}
    }

class ItemBuilder
    {
        protected $itemCount = 0;
        public function __construct()
        {
            $itemCount++;
        }
        function createItem() : Item {}
        function getCount()
           {
               return $itemCount;
           }
    }

class Item
    {
       public function __construct(){}
    }

class ErrorBuilder
    {
        protected $errorCount = 0;
        public function __construct()
        {
            $errorCount++;
        }
        function createError() : Error {}
        function getCount()
           {
               return $errorCount;
           }
    }
class Error
{
    public function __construct(){}
}
?>