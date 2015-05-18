<?php

class StationController extends Zend_Controller_Action
{

    public function init()
    {
         $authorization =Zend_Auth::getInstance();
          if(!$authorization->hasIdentity()&&$this->_request->getActionName()!="login") {
            $this->redirect("user/login");
        }}

    public function indexAction()
    {
        // action body
    }

    public function addstationAction()
    {
        $areamodel=new Application_Model_Area();
        $this->view->allarea=$areamodel->listallarea();
    
         if($this->getRequest()->isPost()){
               
           $data=$this->getRequest()->getParams();
         
           unset($data['controller']);
           unset($data['module']);
           unset($data['action']);
           unset($data['Post']);
           $model=new Application_Model_Station();
           $mydata=$model->addstation($data);
           $this->redirect("/station/viewallstation");

            
 
           }
           

    }

    public function viewallstationAction()
    {
      $model=new Application_Model_Station();
      
      $allstation=$model->listallstation(); 
    
      $this->view->alldataofstation= $allstation;   
    }

    public function deletestationAction()
    {
          
       $model=new Application_Model_Station();
       $id=$this->getRequest()->getParam('st_id');
       $modelid=$model->deletetestation($id); 
       $this->redirect("/station/viewallstation");
      

    }

    public function editstationAction()
    {
        
      
      $areamodel=new Application_Model_Area();
      $this->view->allarea=$areamodel->listallarea(); 
      $st_id=$this->getRequest()->getParam("st_id");          
      $model=new Application_Model_Station();
      $stationdata=$model->getdatabyid($st_id); 
    
      $this->view->mystationdata = $stationdata;
      
      //print_r($transportationdata);
    
      $data=$this->getRequest()->getParams();
     
       if($this->getRequest()->isPost()){
         $data=$this->getRequest()->getParams();
         print_r($data);
           unset($data['controller']);
           unset($data['module']);
           unset($data['action']);
           unset($data['Post']);
       // $data=$form->getValues();
        $model->editstation($data); 
        
        $this->redirect("/station/viewallstation");
     
    }


}








}
