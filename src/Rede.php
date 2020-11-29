<?php

namespace lucasgiovanny\ERede;

use Rede\Environment;
use Rede\eRede;
use Rede\Store;
use Rede\Transaction;

class Rede
{
    /**
     * Store $store
     */
    private Store $_store;

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
     * Authorize one transaction with eRede API.
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
        array $creditCard
    ) {
        $transaction = (new Transaction($total, $reference))
            ->creditCard(
                $creditCard['cardNumber'],
                $creditCard['cardCvv'],
                $creditCard['cardExpirationMonth'],
                $creditCard['cardExpirationYear'],
                $creditCard['cardHolder'],
            );

        $transaction = (new eRede($this->_store))->create($transaction);

        return $transaction;
    }
}
