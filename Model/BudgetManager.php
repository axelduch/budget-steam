<?php
namespace Model;
use \Core\AbstractModel as AbstractModel;

/**
 * purchase
 *  => game
 *  => price
 *  => date
 */ 
class BudgetManager extends AbstractModel {
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
        if (!isset($this->_data)) {
            try {
                $this->_data = simplexml_load_file($this->_dataFilename);
            } catch (Exception $e) {
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
    
    public function addPurchase($gameName, $price, $date = NULL) {
        $gameName = (string) $gameName;
        $price = (float) $price;
        $date = ($date === NULL) ? date('j/m/Y, H\hi') : (string) $date;
        $this->load();
        foreach(($this->_data->history->children()) as $purchase) {
            if ((string) $purchase->game === $gameName) {
                return FALSE;
            }
        }
        $purchase = $this->_data->history->addChild('purchase');
        $purchase->addChild('game', $gameName);
        $purchase->addChild('price', $price);
        $purchase->addChild('date', $date);
        $this->_unsavedModification = TRUE;
        return TRUE;
    }
    
    public function save() {
        if ($this->_unsavedModification) {
            try {
                $dom = new DOMDocument('1.0');
                $dom->preserveWhiteSpace = false;
                $dom->formatOutput = true;
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