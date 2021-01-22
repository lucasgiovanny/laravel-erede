<?php

namespace lucasgiovanny\ERede;

use Rede\Environment;
use Rede\eRede;
use Rede\Store;
use Rede\Transaction;

class Rede
{
    /**
     * eRede Store
     * 
     * @var Store $store
     */
    private $_store;

    /**
     * Init the class with required params
     * 
     * @param string $pv      Filiation number
     * @param string $token   API Token
     * @param bool   $sandbox Sandbox definition
     */
    public function __construct(
        string $pv,
        string $token,
        bool $sandbox = false
    ) {
        $enviroment = $sandbox ? Environment::sandbox() : Environment::production();

        $this->_store = new Store($pv, $token, $enviroment);
    }

    /**
     * Authorize one transaction. Capture by default.
     * 
     * @param float  $total      Total of the transaction
     * @param string $reference  Reference of transaction
     * @param array  $creditCard Credit Card Information
     * 
     * @return eRede
     */
    public function authorize(
        float $total,
        string $reference,
        array $creditCard,
        bool $capture = true,
        int $installments = 1
    ) {
        $transaction = (new Transaction($total, $reference))
            ->creditCard(
                $creditCard['cardNumber'],
                $creditCard['cardCvv'],
                $creditCard['cardExpirationMonth'],
                $creditCard['cardExpirationYear'],
                $creditCard['cardHolder'],
            )
            ->capture($capture)
            ->setInstallments($installments);

        $transaction = (new eRede($this->_store))->create($transaction);

        return $transaction;
    }

    /**
     * Cancel on transaction by transaction ID.
     *
     * @param string $transaction
     * 
     * @return eRede
     */
    public function cancel($transaction)
    {
        $transaction = (new Transaction())->setTid($transaction);

        return (new eRede($this->_store))->cancel($transaction);
    }

    /**
     * Find transaction by reference
     *
     * @param string $reference
     * 
     * @return eRede
     */
    public function getByReference($reference)
    {
        return (new eRede($this->_store))->getByReference($reference);
    }

    /**
     * Find transaction by transaction id
     *
     * @param string $transaction
     * 
     * @return eRede
     */
    public function get($transaction)
    {
        return (new eRede($this->_store))->get($transaction);
    }

    /**
     * Find transactions refunds
     *
     * @param string $transaction
     * 
     * @return eRede
     */
    public function getRefunds($transaction)
    {
        return (new eRede($this->_store))->getRefunds($transaction);
    }
}
