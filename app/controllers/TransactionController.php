<?php
require_once (__DIR__.'/../models/Transaction.php');
class TransactionController extends BaseController {
    private $TransactionModel ;
    public function __construct(){

        $this->TransactionModel = new Transaction();
  
        
     }

     public function AlimenterSolde(){
        if($_POST['accountSelected'] == "courant"){
            $accountID = (int)$_POST['account_courant'];
        }
        else{
            $accountID = (int)$_POST['account_epargne'];
        }
        $mantant = (float)$_POST['montant'];
        $this->TransactionModel->AlimenterSolde($accountID,$mantant);
     }
}


