<?php

namespace bamboo\controllers\widget;

use bamboo\core\router\ANodeController;
use bamboo\ecommerce\views\widget\VBase;


class CBlogArticleListController extends ANodeController {


    public function get(){

        //carico il template
        $this->view = new VBase($this->response->getChildren());
        $this->view->setTemplatePath($this->config['template']['fullpath']);
        // organizzo i dati in ingresso. json, PandORM, o Mixed, in base
        // alla configurazione

        $this->fetchData();
        $this->view->pass('app', $this->helper);
        $this->view->pass('data', $this->dataBag);
        $this->view->pass('domain', $this->app->cfg()->fetch("paths","domain"));
        return $this->show();
    }



    /**
     * @return \bamboo\core\router\CInternalResponse
     */
    public function post() {return $this->get();}

    /**
     * @return \bamboo\core\router\CInternalResponse
     */
    public function put() {return $this->get();}

    /**
     * @return \bamboo\core\router\CInternalResponse
     */
    public function delete() {return $this->get();}

}