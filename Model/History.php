<?php
namespace Model;
use \Core\AbstractModel as AbstractModel,
	\Core\Debug as Debug;

/**
 * purchase
 *  => game
 *  => price
 *  => date
 */ 
class History extends AbstractModel {
	const E_WRONG_GAME_NAME = 1;
	const E_WRONG_PRICE = 2;
	const E_DUPLICATE_ENTRY = 4;
	
	private $_dataFilename;
    protected $_data;
    protected $_unsavedModification;

    public function __construct() {
    	$this->_dataFilename = ROOT . DS . 'var' . DS . 'data' . DS . 'feed.xml';
        try {
            $this->_data = simplexml_load_file($this->_dataFilename);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->_unsavedModification = FALSE;
    }
    
    protected function load() {
    	Debug::log('Entering method ' . __METHOD__);
        if (!isset($this->_data)) {
            try {
                $this->_data = simplexml_load_file($this->_dataFilename);
            } catch (Exception $e) {
            	Debug::log($e->getMessage());
                echo $e->getMessage();
            }
        }
    }
    
    public function getHistory() {
        $this->load();
        return $this->_data->history;
    }
    
    public function getAvailableBudget() {
        $this->load();
        $budget = (float) $this->_data->budget;
        foreach (($this->_data->history->children()) as $purchase) {
            $budget -= (float) $purchase->price;
        }
        return $budget;
    }
    
    public function addPurchase($gameName, $price) {
        $gameName = (string) $gameName;
        $price = (float) $price;
        $date = date('j/m/Y, H\hi');
		if (!$gameName) {
			return self::E_WRONG_GAME_NAME;
		} else if (!preg_match('/[0-9.,]+/', $price)) {
			return self::E_WRONG_PRICE;
		}
        $this->load();
        foreach(($this->_data->history->children()) as $purchase) {
            if ((string) $purchase->game === $gameName) {
                return self::E_DUPLICATE_ENTRY;
            }
        }
        $purchase = $this->_data->history->addChild('purchase');
        $purchase->addChild('game', $gameName);
        $purchase->addChild('price', $price);
        $purchase->addChild('date', $date);
        $this->_unsavedModification = TRUE;
        return $this->_unsavedModification;
    }
    
    public function save() {
        if ($this->_unsavedModification) {
            try {
                $dom = new \DOMDocument('1.0');
                $dom->preserveWhiteSpace = FALSE;
                $dom->formatOutput = TRUE;
                $dom->loadXML($this->_data->asXML());
                file_put_contents($this->_dataFilename, $dom->saveXML());
                $this->_unsavedModification = FALSE;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            return FALSE;
        }
        return ! $this->_unsavedModification;
    }
    
    public function getPurchasedItems() {
        $items = array();
        foreach ($this->_data->history->purchase as $purchase) {
            $items[] = $purchase;
        }
        return $items;
    }
}