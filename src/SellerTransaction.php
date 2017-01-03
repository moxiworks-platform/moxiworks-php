<?php

namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;

class SellerTransaction extends Resource {
    /**
     * @var string the Moxi Works Platform ID of the agent
     *   moxi_works_agent_id is the Moxi Works Platform ID of the agent which a SellerTransaction is
     *   or is to be associated with.
     *
     *   this must be set for any Moxi Works Platform SellerTransaction request
     *
     */
    public $moxi_works_agent_id;

    /**
     * @var string the Moxi Works Platform ID of the SellerTransaction
     *
     */
    public $moxi_works_transaction_id;

    /**
     * @var string the Moxi Works Platform ID of the Contact
     *
     * either moxi_works_contact_id or partner_contact_id can be used
     *
     */
    public $moxi_works_contact_id;

    /**
     * @var string your system's unique ID for the contact
     *   *your system's* unique ID for the Contact associated with this SellerTransaction
     *
     * either moxi_works_contact_id or partner_contact_id can be used
     *
     */
    public $partner_contact_id;

    /**
     * @var string A brief, human readable title that will be shown to the agent as
     * the subject of the SellerTransaction that you are updating.
     *
     */
    public $transaction_name;

    /**
     * @var string Brief, human readable content that will be shown to the agent as
     * notes about the SellerTransaction that you are updating.
     *
     */
    public $notes;

    /**
     * @var integer the stage of the transaction
     *
     * Each SellerTransaction has five stages (1-5). stage displays the
     * stage number that the SellerTransaction is currently in.
     *
     * This will be a single digit integer that can be [1,2,3,4,5].
     * For more information on SellerTransaction stages see
     * { @link https://moxiworks-platform.github.io/#sellertransaction-stages The Moxi Works Platform Documentation }
     *
     */
    public $stage;

    /**
     * @var string a human readable string representing the stage the transaction is in
     *
     * This attribute displays a human readable stage name that is
     * associated with the current stage attribute. When created
     * through the Moxi Works Platform SellerTransaction objects
     * will automatically be configured as 'active' transactions.
     *
     * This will be an enumerated string that can be can be
     * 'initialized', 'configured' , 'active' , 'pending'  or 'complete'
     * For more information on SellerTransaction stages see
     * { @link https://moxiworks-platform.github.io/#sellertransaction-stages The Moxi Works Platform Documentation }
     *
     */
    public $stage_name;

    /**
     * @var string street address of the property being sold
     *
     */
    public $address;

    /**
     * @var string city of the property being sold
     *
     */
    public $city;

    /**
     * @var string state of the property being sold
     *
     */
    public $state;

    /**
     * @var string zip_code of the property being sold
     *
     */
    public $zip_code;

    /**
     * @var integer living area of the property being sold
     *
     */
    public $sqft;

    /**
     * @var integer bedrooms in the property being sold
     *
     */
    public $beds;

    /**
     * @var float bathrooms the property being sold
     *
     */
    public $baths;


    /**
     * @var boolean Whether the property being sold is being listed on an MLS.
     *
     */
    public $is_mls_transaction;


    /**
     *
     * **MLS TRANSACTIONS ONLY**
     * mls number for the listing associated with this SellerTransaction
     *
     * @var string the MLS number of the listing associated with this SellerTransaction
     *
     * -- mls_number should be populated only if is_mls_transaction is true.
     *
     **/
    public $mls_number;


    /**
     *
     * **NON MLS TRANSACTIONS ONLY ** this is the Unix timestamp
     *   representing the date the property associated with the
     *   SellerTransaction was put up for sale. This should be null if the
     *   SellerTransaction is an MLS sale.
     *
     * @var Integer Unix timestamp
     *
     **/
    public $start_timestamp;


    /**
     *
     * If the agent is to receive commission based on percentage of sale
     * price for the property associated with this SellerTransaction, then
     * this will represent the commission that the agent is to receive.This
     * should be null if the SellerTransaction uses commission_flat_fee.
     *
     * -- both commission_flat_fee and commission_percentage cannot be set
     *
     * @var float
     *
     **/
    public $commission_percentage;

    /**
     *
     * If the agent is to receive a flat-rate commission upon sale of the
     * property associated with this SellerTransaction, then this will
     * represent the commission that the agent is to receive. This should
     * be null if the SellerTransaction uses commission_percentage.
     *
     * -- both commission_flat_fee and commission_percentage cannot be set
     *
     * @var integer
     *
     **/
    public $commission_flat_fee;


    /**
     *
     * The desired selling price for the property if using target rather
     * than range.
     *
     * -- both target_price and price cannot be set
     *
     * @var integer
     *
     **/
    public $target_price;


    /**
     *
     * The minimum price range for the property if using a price range
     * rather than target price.
     *
     * -- both target_price and min_price cannot be set
     *
     * @var integer
     *
     **/
    public $min_price;


    /**
     *
     * The maximum price range for the property if using a price range
     * rather than target price.
     *
     * -- both target_price and max_price cannot be set
     *
     * @var integer
     *
     **/
    public $max_price;


    /**
     *
     * This is the closing price for the sale . This should be null if the
     * SellerTransaction is not yet in complete state.
     *
     * @var integer
     *
     **/
    public $closing_price;


    /**
     *
     * A Unix timestamp representing the point in time when the
     * transaction for this SellerTransaction object was completed. This
     * should be null if the SellerTransaction is not yet in complete state.
     *
     * @var integer;
     *
     **/
    public $closing_timestamp;

    /**
     *
     * In order to promote a SellerTransaction to the next stage, set  the
     * promote_transaction attribute to true. For more information about
     * SellerTransaction stages, see { @link https://moxiworks-platform.github.io/#promoting-sellertransaction-stage The Moxi Works Platform Documentation. }
     * promote_transaction is only available for SellerTransaction updates.
     * Newly created SellerTransaction objects will automatically be created in
     * stage 3 (active)
     *
     * @var boolean
     *
     * */
    public $promote_transaction;


    /**
     * SellerTransaction constructor.
     * @param array $data
     */
    function __construct(array $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     *  Create a SellerTransaction on The Moxi Works Platform
     * <code>
     *   MoxiworksPlatform\SellerTransaction::create([
     *     'moxi_works_agent_id' => '123abc',
     *      'moxi_works_contact_id' =>'deadbeef-dead-beef-bad4-feedfacebad',
     *      'notes' => 'foo deeaz',
     *      'name' => 'whateverz'
     *      'address' => '1234 there ave',
     *      'city' => 'cityville'
     *      'state' =>  'provinceland',
     *      'zip_code' => '12323',
     *      'beds' => 12,
     *      'baths' => 34.5,
     *      'sqft' => 12345,
     *      'is_mls_transaction' => true,
     *      'commission_flat_fee' => nil,
     *      'commission_percentage' => 12.34,
     *      'target_price' => 12345,
     *      'min_price' => nil,
     *      'max_price' => nil,
     *      'mls_number' => 'abc1234']);
     * </code>
     *
     *
     *        <br><b> moxi_works_agent_id *REQUIRED*</b> The Moxi Works Agent ID for the agent to which this transaction is to be associated
     *        <br><b> partner_transaction_id *REQUIRED*</b> Your system's unique ID for this transaction.
     *        <br><b> partner_contact_id *REQUIRED*</b> Your system's unique id for associated contact. should already have been created in Moxi Works Platform.
     *
     *          <h2>
     *              optional SellerTransaction parameters
     *          </h2>
     *
     *        <br><b> notes</b> human readable notes associated with the transaction meaningful to the agent
     *        <br><b> name</b> short description of the transaction meaningful to the agent
     *        <br><b> address</b> street address of the property associated with the transaction
     *        <br><b> city</b> city of the property associated with the transaction
     *        <br><b> state</b> state or province of the property associated with the transaction
     *        <br><b> zip_code</b>  postal code of the property associated with the transaction
     *        <br><b> beds</b> number of bedrooms associated with the transaction
     *        <br><b> baths</b> number of bathrooms associated with the transaction
     *        <br><b> sqft</b> square feet of living area associated with the transaction
     *        <br><b> max_sqft</b> maximum square feet of living area desired for transaction
     *        <br><b> area_of_interest</b> an area that desired for the transaction
     *        <br><b> transaction_state</b> current state of the transaction, can be 'marketing', 'prospects' , 'actives' , 'pending'  , 'completed'
     *        <br><b> transaction_category</b> category of transaction, can be 'buyer', 'seller'
     *        <br><b> commission_flat_fee</b> how much the commission is if flat fee
     *        <br><b> commission_percentage</b> what percentage the commission is if percentage based
     *        <br><b> target_price</b>  target price associated with the transaction
     *        <br><b> price</b>  price associated with the transaction
     *        <br><b> max_price</b> maximum price associated with the transaction
     *        <br><b> mls_number</b>  mls number associated with the transaction
     *        <br><b> closing_price</b>  closing price associated with the transaction
     *        <br><b> closing_timestamp</b>  Unix timestamp representing the date the transaction closed associated with the transaction
     *
     *
     *
     * @param array $attributes
     *
     * @return SellerTransaction|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function create($attributes=[]) {
        return SellerTransaction::sendRequest('POST', $attributes);
    }

    /**
     *  Update a previously created SellerTransaction on The Moxi Works Platform
     * <code>
     *   MoxiworksPlatform\SellerTransaction::create([
     *     'moxi_works_agent_id' => '123abc',
     *      'moxi_works_transaction_id' =>'deadbeef-dead-beef-bad4-feedfacebad',
     *      'notes' => 'foo deeaz',
     *      'name' => 'whateverz'
     *      'address' => '1234 there ave',
     *      'city' => 'cityville'
     *      'state' =>  'provinceland',
     *      'zip_code' => '12323',
     *      'beds' => 12,
     *      'baths' => 34.5,
     *      'sqft' => 12345,
     *      'is_mls_transaction' => true,
     *      'commission_flat_fee' => nil,
     *      'commission_percentage' => 12.34,
     *      'target_price' => 12345,
     *      'min_price' => nil,
     *      'max_price' => nil,
     *      'mls_number' => 'abc1234',
     *      'closing_timestamp' => time(),
     *      'closing_price' => 123456,
     *      'promote_transaction => true
     * ]);
     * </code>
     *
     *
     *        <br><b> moxi_works_agent_id *REQUIRED*</b> The Moxi Works Agent ID for the agent to which this transaction is to be associated
     *        <br><b> partner_transaction_id *REQUIRED*</b> The Moxi Works Platform unique ID for the SellerTransaction you want to update.
     *
     *          <h2>
     *              optional SellerTransaction parameters
     *          </h2>
     *
     *        <br><b> notes</b> human readable notes associated with the transaction meaningful to the agent
     *        <br><b> name</b> short description of the transaction meaningful to the agent
     *        <br><b> address</b> street address of the property associated with the transaction
     *        <br><b> city</b> city of the property associated with the transaction
     *        <br><b> state</b> state or province of the property associated with the transaction
     *        <br><b> zip_code</b>  postal code of the property associated with the transaction
     *        <br><b> beds</b> number of bedrooms associated with the transaction
     *        <br><b> baths</b> number of bathrooms associated with the transaction
     *        <br><b> sqft</b> square feet of living area associated with the transaction
     *        <br><b> max_sqft</b> maximum square feet of living area desired for transaction
     *        <br><b> area_of_interest</b> an area that desired for the transaction
     *        <br><b> transaction_state</b> current state of the transaction, can be 'marketing', 'prospects' , 'actives' , 'pending'  , 'completed'
     *        <br><b> transaction_category</b> category of transaction, can be 'buyer', 'seller'
     *        <br><b> commission_flat_fee</b> how much the commission is if flat fee
     *        <br><b> commission_percentage</b> what percentage the commission is if percentage based
     *        <br><b> target_price</b>  target price associated with the transaction
     *        <br><b> price</b>  price associated with the transaction
     *        <br><b> max_price</b> maximum price associated with the transaction
     *        <br><b> mls_number</b>  mls number associated with the transaction
     *        <br><b> closing_price</b>  closing price associated with the transaction
     *        <br><b> closing_timestamp</b>  Unix timestamp representing the date the transaction closed associated with the transaction
     *        <br><b> promote_transaction</b> If this is set to true then The Moxi Works Platform will promote this transaction to the next stage
     *
     *
     * @param array $attributes
     *
     * @return SellerTransaction|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function update($attributes=[]) {
        $required_opts = array('moxi_works_transaction_id');
        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");
        $url = Config::getUrl() . "/api/seller_transactions/" . $attributes['moxi_works_transaction_id'];
        return SellerTransaction::sendRequest('PUT', $attributes, $url);
    }

    /**
     * Find a previously created SellerTransaction on Moxi Works Platform.
     *
     * find can be performed including the Moxi Works SellerTransaction id and the Moxi Works Agent ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\SellerTransaction::find([moxi_works_agent_id: 'abc123', moxi_works_transaction_id: 'deadbeef-feed-face-bad4-dad2feedface'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Platform Agent ID for the agent to which this transaction is to be associated
     *       <br><b>moxi_works_transaction_id *REQUIRED* </b>The Moxi Works Platform SellerTransaction ID.
     *
     *
     * @return SellerTransaction|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        $required_opts = array('moxi_works_transaction_id');
        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        return SellerTransaction::sendRequest('GET', $attributes);
    }



    /**
     * Search for SellerTransaction objects for an Agent on Moxi Works Platform.
     *
     * search can be performed by including moxi_works_agent_id in a parameter array
     *  <code>
     *  \MoxiworksPlatform\SellerTransaction::search(['moxi_works_agent_id' => 'abc123', 'page_number' => 3, moxi_works_contact_id => 'deadbeef-feed-face-bad4-dad2feedface'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b> string The Moxi Works Agent ID for the agent to which this task is associated
     *
     *       <h2>
     *     optional SellerTransaction search parameters
     * </h2>
     *      <br><b>moxi_works_contact_id</b> The Moxi Works Platform Contact ID for a specific Contact about whom SellerTransactions are to be returned -- either moxi_works_contact_id or partner_contact_id can be used
     *      <br><b>partner_contact_id</b>  your system's ID for a specific contact for whom SellerTransaction objects are to be returned  -- either moxi_works_contact_id or partner_contact_id can be used
     *      <br><b>page_number</b>  page number of responses to return (if number of responses spans a beyond a single page of responses)
     *
     * @return Array paged response array with the format:
     *   [
     *     page_number: [Integer],
     *     total_pages: [Integer],
     *     transactions:  [Array] containing MoxiworkPlatform\SellerTransaction objects
     *   ]
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/seller_transactions";
        $transactions = array();

        $required_opts = array('moxi_works_agent_id');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return null;

        foreach ($json['transactions'] as $c) {
            $transaction = new SellerTransaction($c);
            array_push($transactions, $transaction);
        }
        $json['transactions'] = $transactions;
        return $json;
    }



    /**
     * Save SellerTransaction to Moxi Works Platform
     *
     * <code>
     *   $transaction = MoxiworksPlatform\SellerTransaction::find([
     *     moxi_works_agent_id: '123abc', moxi_works_transaction_id: 'defjhi]);
     *   $transaction->city = 'Cityville';
     *   $transaction->save();
     * </code>
     *
     * @return SellerTransaction|null
     */
    public function save() {
        return SellerTransaction::update((array) $this);
    }


    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return SellerTransaction|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/seller_transactions";
        }
        $required_opts = array('moxi_works_agent_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");
        $seller_transaction = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $seller_transaction = (!isset($json) || empty($json)) ? null : new SellerTransaction($json);
        return $seller_transaction;
    }

}