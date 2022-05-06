<?php

////// SQUARE API INTEGRATION //////
require 'vendor/autoload.php';

use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;

define(SQUARE_ACCESS_TOKEN, "EAAAEAKGqT5HJRmmABos29dEnrME4iYc6xjeFChAJCwSvXxbx6l2fPAGX6rta_oG");
define(SQUARE_APPLICATION_ID, "sandbox-sq0idb-VJ0u64Lfk4fWpYxu5P_6pg");
define(LOCATION_ID, "L9ARQHGTNAH8D");


$client = new SquareClient([
    'accessToken' => SQUARE_ACCESS_TOKEN,
    'environment' => Environment::SANDBOX,
]);

$cardsApi = $client->getCardsApi();

$paymentsApi = $client->getPaymentsApi();

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

    public function __construct(){}
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
    }
    function createTransaction() : Transaction
    {
        $transaction = new Transaction();
        $cardData = $transaction->promptCard();
        $card = $transaction->createCard($cardData);
        $paymentData = $transaction->promptPayment();
        $payment = $transaction->createPayment($paymentData);
        $transactionCount++;
    }
    function getCount()
    {
        return $transactionCount;
    }
}

class Transaction
{
    protected $transactionID;
    protected $senderID;
    protected $receiverID;
    protected $itemID;
    protected $transactionAmount;
    protected $date;

    public function __construct($transactionID, $senderID, $receiverID, $transactionAmount, $date)
    {
        $this->transactionID = $transactionID;
        $this->senderID = $senderID;
        $this->receiverID = $receiverID;
        $this->itemID = $itemID;
        $this->transactionAmount = $transactionAmount;
        $this->date = $date;
    }

    function getTransactionID() : int {return $transactionID;}
    function getSenderID() : int {return $senderID;}
    function getReceiverID() : int {return $receiverID;}
    function getItemID() : int {return $itemID;}
    function getTransactionAmount() : double {return $transactionAmount;}
    function getDate() : string {return $date;}

    function setTransactionID() {$this->transactionID = $transactionID;}
    function setSenderID() {$this->senderID = $senderID;}
    function setReceiverID() {$this->receiverID = $receiverID;}
    function setItemID() {$this->itemID = $itemID;}
    function setTransactionAmount() {$this->transactionAmount = $transactionAmount;}
    function setDate() {$this->date = $date;}


    function promptCard() : array {}
    function createCard($card)
    {
        $idempotencyKey = $card->getIndepodenceyKey();
        $sourceID = $card->getSourceID();


        $body = new Models\Card;

        $body->setID($card->getAccountID());
        $body->setCardBrand($card->getCardBrand());
        $body->setLast4($card->getLastFour());
        $body->setExpMonth($card->getMonth());
        $body->setExpYear($card->getYear());
        $body->setCardholderName($card->getFirstName() . " " . $card->getLastName());
        $body->setBillingAddress(new Models\Address);
        $body->getBillingAddress()->setAddressLine1($card->getBillingAddress()->getLineOne());
        $body->getBillingAddress()->setAddressLine2($card->getBillingAddress()->getLineTwo());
        $body->getBillingAddress()->setAddressLine3($card->getBillingAddress()->getLineThree());
        $body->getBillingAddress()->setLocality($card->getBillingAddress()->getCity());
        $body->getBillingAddress()->setAdministrativeDistrictLevel1($card->getBillingAddress()->getState());
        $body->getBillingAddress()->setPostalCode($card->getBillingAddress()->getZipCode());
        $body->getBillingAddress()->setCountry(Models\Country::US);
        $body->setCustomerId($card->getCustomerID());
        $body->setReferenceId($card->getReferenceID());

        $request = new Models\CreateCardRequest($indepodenceyKey, $sourceID, $body);

        $request->setVerificationToken(uniqid());

        $apiResponse = $cardsApi->createCard($request);

        if ($apiResponse->isSuccess()) {
            $createCardResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }
    }
    function promptPayment() : array {}
    function createPayment($payment)
    {
        $body_sourceId = $payment->getSourceID();
        $body_idempotencyKey = $payment->getIndepodenceyKey();
        $body_amountMoney = new Models\Money;
        $body_amountMoney->setAmount($payment->getAmount());
        $body_amountMoney->setCurrency(Models\Currency::USD);
        $body = new Models\CreatePaymentRequest(
            $body_sourceId,
            $body_idempotencyKey,
            $body_amountMoney
        );
        $body->setTipMoney(new Models\Money);
        $body->getTipMoney()->setAmount($payment->getTipAmount());
        $body->getTipMoney()->setCurrency(Models\Currency::USD);
        $body->setAppFeeMoney(new Models\Money);
        $body->getAppFeeMoney()->setAmount($payment->getAppFee());
        $body->getAppFeeMoney()->setCurrency(Models\Currency::USD);
        $body->setOrderId($payment->getOrderID());
        $body->setCustomerId($payment->getCustomerID());
        $body->setLocationId(LOCATION_ID);
        $body->setReferenceId($payment->getReferenceID());

        $apiResponse = $paymentsApi->createPayment($body);

        if ($apiResponse->isSuccess()) {
            $createPaymentResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }
    }
    function listPayments($params) : array {}
    function updatePayment($payment) : array {}
    function completePayment($payment) : bool {}
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

       protected $firstName;
       protected $lastName;
       protected $email;
       protected $accountID;
       protected $username;
       protected $password;
       protected $profile;

       public function __construct(){}

       function getFirstName() : string {return $firstName;}
       function getLastName() : string {return $lastName;}
       function getEmail() : string {return $email;}
       function getAccountID() : int {return $accountID;}
       function getUsername() : string {return $username;}
       function getPassword() : string {return $password;}
       function getProfile() : string {return $profile;}

       function setFirstName($firstName) {$this->firstName = $firstName;}
       function setLastName($lastName) {$this->lastName = $lastName;}
       function setEmail($email) {$this->email = $email;}
       function setAccountID($accountID) {$this->accountID = $accountID;}
       function setUsername($username) {$this->username = $username;}
       function setPassword($password) {$this->password = $password;}
       function setProfile($profile) {$this->profile = $profile;}

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
       protected $itemID;
       protected $itemName;
       protected $itemPrice;
       protected $itemPicture;
       protected $quantity;

       public function __construct($itemID, $itemName, $itemPrice, $itemPicture, $quantity)
       {
            $this->itemID = $itemID;
            $this->itemName = $itemName;
            $this->itemPrice = $itemPrice;
            $this->itemPicture = $itemPicture;
            $this->quantity = $quantity;
       }

       function getItemID(){return $itemID;}
       function getItemName(){return $itemName;}
       function getItemPrice(){return $itemPrice;}
       function getItemPicture(){return $itemPicture;}
       function getQuantity(){return $quantity;}


       function setItemID($itemID) {$this->itemID = $itemID;}
       function setItemName($itemName) {$this->itemName = $itemName;}
       function setItemPrice($itemPrice) {$this->itemPrice = $itemPrice;}
       function setItemPicture($itemPicture) {$this->itemPicture = $itemPicture;}
       function setQuantity($quantity) {$this->quantity = $quantity;}

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





