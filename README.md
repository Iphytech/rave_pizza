# rave_pizza

### Clone the repo

### cd to the project directory

Follow the guide here to step up Rave in your project

https://laravelrave.netlify.com/getting-started/installation.html#prerequisite

After setting up Rave in your project

##### Goto Vendor folder -> KingFalmez -> laravelrave -> src -> Rave.php

##### Then replace the initialize function with this 

*****************************************************************
 public function initialize($redirectURL)
  {
      $meta = array();
      if (!empty($this->request->metadata)) {
          $meta = json_decode($this->request->metadata, true);
      }
    
      $subAccounts = array();
      if (!empty($this->request->subaccounts)) {
          $subAccounts = json_decode($this->request->subaccounts, true);
      }
    
      $this->createCheckSum($redirectURL);
      $this->transactionData = array_merge($this->transactionData, array('data-integrity_hash' => $this->integrityHash), array('meta' => $meta));
    
      if (!empty($subAccounts)) {
        $this->transactionData = array_merge($this->transactionData, array('subaccounts' => $subAccounts));
      }
    
      $json = json_encode($this->transactionData);
      echo '<html>';
      echo '<body>';
      echo '<center>Proccessing...<br /><img style="height: 50px;" src="https://media.giphy.com/media/swhRkVYLJDrCE/giphy.gif" /></center>';
      echo '<script type="text/javascript" src="' . $this->baseUrl . '/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>';
      echo '<script>';
      echo 'document.addEventListener("DOMContentLoaded", function(event) {';
      echo 'var data = JSON.parse(\'' . $json . '\');';
      echo 'getpaidSetup(data);';
      echo '});';
      echo '</script>';
      echo '</body>';
      echo '</html>';
      return $json;
      }
     
