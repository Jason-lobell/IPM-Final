<?php
////// SQUARE API INTEGRATION //////
require 'vendor/autoload.php';
use Square\Models;
use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;

$SQUARE_ACCESS_TOKEN = "EAAAEAKGqT5HJRmmABos29dEnrME4iYc6xjeFChAJCwSvXxbx6l2fPAGX6rta_oG";
$SQUARE_APPLICATION_ID = "sandbox-sq0idb-VJ0u64Lfk4fWpYxu5P_6pg";


$client = new SquareClient([
    'accessToken' => $SQUARE_ACCESS_TOKEN,
    'environment' => Environment::SANDBOX,
]);

$cardsApi = $client->getCardsApi();

$paymentsApi = $client->getPaymentsApi();

// Card object => Used to create object that can pass parameters to the api
class Card
{
    public $sourceID;
    public $referenceID;
    public $customerID;
    public $indepodenceyKey;
    public $firstName;
    public $lastName;
    public $lastFour;
    public $cardBrand;
    public $month;
    public $year;
    //BillingAddress object
    public $addressToken;

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
        public function getSourceID() : int {return $this->sourceID;}
        function getReferenceID() : int {return $this->referenceID;}
        function getCustomerID() : int {return $this->customerID;}
        function getIndepodenceyKey() : string {return $this->indepodenceyKey;}
        function getfirstName() : string {return $this->firstName;}
        function getCardBrand() : string {return $this->cardBrand;}
        function getLastName() : string {return $this->lastName;}
        function getLastFour() : int {return $this->lastFour;}
        function getMonth() : int {return $this->month;}
        function getYear() : int {return $this->year;}
        function getAddressToken() : BillingAddress {return $this->addressToken;}
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
        public $lineOne;
        public $lineTwo;
        public $lineThree;
        public $state;
        public $city;
        public $zipCode;
        public $country;

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
            function getLineOne() : string {return $this->lineOne;}
            function getLineTwo() : string {return $this->lineTwo;}
            function getLineThree() : string {return $this->lineThree;}
            function getState() : string {return $this->state;}
            function getZipCode() : int{return $this->zipCode;}
            function getCity() : string{return $this->city;}
            function getCountry() : string{return $this->country;}
        // Setters
            function setLineOne($lineOne){$this->lineOne = $lineOne;}
            function setLineTwo($lineTwo){$this->lineTwo = $lineTwo;}
            function setLineThree($lineThree){$this->lineThree = $lineThree;}
            function setState($state){$this->state = $state; }
            function setZipCode($zipCode){$this->zipCode = $zipCode;}
            function setCity($city){$this->city = $city;}
            function setCountry($country){$this->country = $country;}
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
        function getSourceID() : int {return $this->sourceID;}
        function getReferenceID() : int {return $this->referenceID;}
        function getCustomerID() : int {return $this->customerID;}
        function getIndepodenceyKey() : string{return $this->indepodenceyKey;}
        function getOrderID() : int {return $this->orderID;}
        function getAmount() : float {return $this->amount;}
        function getAppFee() : float {return $this->appFee;}
        function getTipAmount() : float {return $this->tipAmount;}

    // Setters
        function setSourceID($sourceID){$this->sourceID = $sourceID;}
        function setReferenceID($referenceID){$this->referenceID = $referenceID;}
        function setCustomerID($customerID){$this->customerID = $customerID;}
        function setIndepodenceyKey($indepodenceyKey){$this->indepodenceyKey = $indepodenceyKey;}
        function setOrderID($orderID){$this->orderID = $orderID;}
        function setAmount($amount){$this->amount = $amount;}
        function setAppFee($appFee){$this->appFee = $appFee;}
        function setTipAmount($tipAmount){$this->tipAmount = $tipAmount;}



}

// EventHandler object => in charge of coordinating events and responses on the site

class EventHandler
{
    public function __construct(){}
    function createEvent($eventType) : Event {
        $event = new Event($eventType);
        return $event;
    }
    function createResponse($eventType) : Response {
        $response = new Response($eventType);
        return $response;
    }
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
        $this->eventID++;
    }

}

class Response
{

    public $eventType;
    public $responseID = 0;
    public $data;

    public function __construct($eventType)
    {
        $this->eventType = $eventType;
        $this->responseID++;
        switch($eventType) {

            case EventType::Transaction:
                $this->data = $this->promptTransaction();
                break;
            case EventType::Account:
                $this->data = $this->promptAccountRegistration();
                break;
            case EventType::Item:
                $this->data = $this->promptItemCreation();
                break;
            case EventType::Error:
                $this->data = $this->promptError();
                break;
        }
    }

    // TODO prompt object creation (passed off to builder objects)
    function promptTransaction() : array {}
    function promptAccountRegistration() : array {}
    function promptItemCreation() : array {}
    function promptError() : array {}
    function getData() : array {return $this->data;}
}
class TransactionBuilder
{
    protected $eventHandler;
    protected $transactionCount = 0;
    public function __construct()
    {
        $this->eventHandler = new EventHandler();
    }
    function createTransaction() : Transaction
    {
        $eventType = EventType::Transaction;

            $event = $this->eventHandler->createEvent($eventType);
            $response = $this->eventHandler->createResponse($eventType);

        $data = $response->getData();
        $transaction = new Transaction($data[0],$data[1],$data[2],$data[3],$data[4],$data[5]);
        $cardData = $transaction->promptCard();
        $card = $transaction->createCard($cardData);
        $paymentData = $transaction->promptPayment();
        $payment = $transaction->createPayment($paymentData);
        $this->transactionCount++;
        return $transaction;
    }
    function getCount()
    {
        return $this->transactionCount;
    }
}
class AccountBuilder
{
    protected $accountCount = 0;
    public function __construct()
    {
        $this->accountCount++;
    }
// function createAccount() : Account {}
    function getCount()
    {
        return $this->accountCount;
    }
}

class ItemBuilder
{
    protected $itemCount = 0;
    public function __construct()
    {
        $this->itemCount++;
    }
// function createItem() : Item {}
    function getCount()
    {
        return $this->itemCount;
    }
}
class ErrorBuilder
{
    protected $errorCount = 0;
    public function __construct()
    {
        $this->errorCount++;
    }
// function createError() : Error {}
    function getCount()
    {
        return $this->errorCount;
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
    public $LOCATION_ID = "L9ARQHGTNAH8D";


    public function __construct($transactionID, $senderID, $receiverID,$itemID, $transactionAmount, $date)
    {
        $this->transactionID = $transactionID;
        $this->senderID = $senderID;
        $this->receiverID = $receiverID;
        $this->itemID = $itemID;
        $this->transactionAmount = $transactionAmount;
        $this->date = $date;
    }

    function getTransactionID() : int {return $this->transactionID;}
    function getSenderID() : int {return $this->senderID;}
    function getReceiverID() : int {return $this->receiverID;}
    function getItemID() : int {return $this->itemID;}
    function getTransactionAmount() : float {return $this->transactionAmount;}
    function getDate() : string {return $this->date;}

    function setTransactionID($transactionID) {$this->transactionID = $transactionID;}
    function setSenderID($senderID) {$this->senderID = $senderID;}
    function setReceiverID($receiverID) {$this->receiverID = $receiverID;}
    function setItemID($itemID) {$this->itemID = $itemID;}
    function setTransactionAmount($transactionAmount) {$this->transactionAmount = $transactionAmount;}
    function setDate($date) {$this->date = $date;}

    // TODO
    function promptCard() : array {}
    function promptPayment() : array {}
    function completePayment($payment) : bool {}

    function createCard($card) : Card
    {
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
        $idempotencyKey = $card->getIndepodenceyKey();
        $request = new Models\CreateCardRequest($idempotencyKey, $sourceID, $body);

        $request->setVerificationToken(uniqid());

        $apiResponse = $this->cardsApi->createCard($request);

        if ($apiResponse->isSuccess()) {
            $createCardResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }
        return $card;
    }
    function createPayment($payment) : Payment
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
        $body->setLocationId($this->LOCATION_ID);
        $body->setReferenceId($payment->getReferenceID());

        $apiResponse = $this->paymentsApi->createPayment($body);

        if ($apiResponse->isSuccess()) {
            $createPaymentResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }
        return $payment;
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

       public function __construct($firstName, $lastName, $email, $accountID, $username, $password, $profile){
           $this->password = $password;
           $this->firstName = $firstName;
           $this->lastName = $lastName;
           $this->email = $email;
           $this->accountID = $accountID;
           $this->username = $username;
           $this->profile = $profile;
       }

       function getFirstName() : string {return $this->firstName;}
       function getLastName() : string {return $this->lastName;}
       function getEmail() : string {return $this->email;}
       function getAccountID() : int {return $this->accountID;}
       function getUsername() : string {return $this->username;}
       function getPassword() : string {return $this->password;}
       function getProfile() : string {return $this->profile;}

       function setFirstName($firstName) {$this->firstName = $firstName;}
       function setLastName($lastName) {$this->lastName = $lastName;}
       function setEmail($email) {$this->email = $email;}
       function setAccountID($accountID) {$this->accountID = $accountID;}
       function setUsername($username) {$this->username = $username;}
       function setPassword($password) {$this->password = $password;}
       function setProfile($profile) {$this->profile = $profile;}

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

       function getItemID(){return $this->itemID;}
       function getItemName(){return $this->itemName;}
       function getItemPrice(){return $this->itemPrice;}
       function getItemPicture(){return $this->itemPicture;}
       function getQuantity(){return $this->quantity;}


       function setItemID($itemID) {$this->itemID = $itemID;}
       function setItemName($itemName) {$this->itemName = $itemName;}
       function setItemPrice($itemPrice) {$this->itemPrice = $itemPrice;}
       function setItemPicture($itemPicture) {$this->itemPicture = $itemPicture;}
       function setQuantity($quantity) {$this->quantity = $quantity;}

    }


class Error
{
    public function __construct(){}
}

class Test {
///// TEST CODE /////
}
?>



