<?php
$cardsApi = $client->getCardsApi();

    // Create Card API Call => CreateCardResponse

        $body_idempotencyKey = '';
        $body_sourceId = '';
        $body_card = new Models\Card;
        $body_card->setId('');
        $body_card->setCardBrand(Models\CardBrand::INTERAC);
        $body_card->setLast4('');
        $body_card->setExpMonth(0);
        $body_card->setExpYear(0);
        $body_card->setCardholderName('');
        $body_card->setBillingAddress(new Models\Address);
        $body_card->getBillingAddress()->setAddressLine1('');
        $body_card->getBillingAddress()->setAddressLine2('');
        $body_card->getBillingAddress()->setAddressLine3('');
        $body_card->getBillingAddress()->setLocality('');
        $body_card->getBillingAddress()->setSublocality('');
        $body_card->getBillingAddress()->setAdministrativeDistrictLevel1('');
        $body_card->getBillingAddress()->setPostalCode('');
        $body_card->getBillingAddress()->setCountry(Models\Country::US);
        $body_card->setCustomerId('');
        $body_card->setReferenceId('');
        $body = new Models\CreateCardRequest(
            $body_idempotencyKey,
            $body_sourceId,
            $body_card
        );
        $body->setVerificationToken('');

        $apiResponse = $cardsApi->createCard($body);

        if ($apiResponse->isSuccess()) {
            $createCardResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }

    // Disable Card API Call => DisableCardResponse

        $cardId = '';

        $apiResponse = $cardsApi->disableCard($cardId);

        if ($apiResponse->isSuccess()) {
            $disableCardResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }

    // List Cards API Call => ListCardsResponse

        $cursor = '';
        $customerId = '';
        $includeDisabled = false;
        $referenceId = '';
        $sortOrder = Models\SortOrder::DESC;

        $apiResponse = $cardsApi->listCards($cursor, $customerId, $includeDisabled, $referenceId, $sortOrder);

        if ($apiResponse->isSuccess()) {
            $listCardsResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }

$paymentsApi = $client->getPaymentsApi();

    // Create Payments API Call => CreatePaymentResponse

        $body_sourceId = '';
        $body_idempotencyKey = '';
        $body_amountMoney = new Models\Money;
        $body_amountMoney->setAmount(0);
        $body_amountMoney->setCurrency(Models\Currency::USD);
        $body = new Models\CreatePaymentRequest(
            $body_sourceId,
            $body_idempotencyKey,
            $body_amountMoney
        );
        $body->setTipMoney(new Models\Money);
        $body->getTipMoney()->setAmount(0);
        $body->getTipMoney()->setCurrency(Models\Currency::CHF);
        $body->setAppFeeMoney(new Models\Money);
        $body->getAppFeeMoney()->setAmount(0);
        $body->getAppFeeMoney()->setCurrency(Models\Currency::USD);
        $body->setDelayDuration('');
        $body->setOrderId('');
        $body->setCustomerId('');
        $body->setLocationId('');
        $body->setReferenceId('');
        $body->setNote('');

        $apiResponse = $paymentsApi->createPayment($body);

        if ($apiResponse->isSuccess()) {
            $createPaymentResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }

    // List Payments Example API Call => ListPaymentResponse

        $beginTime = '';
        $endTime = '';
        $sortOrder = '';
        $cursor = '';
        $locationId = '';
        $total = 0;
        $last4 = '';
        $cardBrand = '';
        $limit = 0;

        $apiResponse = $paymentsApi->listPayments($beginTime, $endTime, $sortOrder, $cursor, $locationId, $total, $last4, $cardBrand, $limit);

        if ($apiResponse->isSuccess()) {
            $listPaymentsResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }

        // Cancel Payments Example API Call => CancelPaymentResponse
        $paymentId = '';

        $apiResponse = $paymentsApi->cancelPayment($paymentId);

        if ($apiResponse->isSuccess()) {
            $cancelPaymentResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }

        // Complete Payments Example API Call => CompletePaymentResponse

        $paymentId = '';
        $body = new Models\CompletePaymentRequest;
        $body->setVersionToken('');

        $apiResponse = $paymentsApi->completePayment($paymentId, $body);

        if ($apiResponse->isSuccess()) {
            $completePaymentResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
        }

?>