<?php

namespace bamboo\controllers\widget;

use bamboo\core\asset\CHeadTag;
use bamboo\core\router\ANodeController;
use bamboo\ecommerce\views\widget\VBase;


class CBlogSingleContentController extends ANodeController {


	public function get() {

		$this->view = new VBase($this->response->getChildren());
		$this->view->setTemplatePath($this->config['template']['fullpath']);

		$this->fetchData();

		try {
			$this->app->router->response()->addHeadTag(
				new CHeadTag('meta', null, null, ["property" => "fb:app_id",
                                                  "content" => $this->app->cfg()->fetch('miscellaneous','facebook')['app_id']]));
			$this->app->router->response()->addHeadTag(
				new CHeadTag('meta', null, null, ["property" => "og:url",
                                                  "content" => $this->app->baseUrl(false).$this->app->router->request()->getUrlPath()]));
			$this->app->router->response()->addHeadTag(
				new CHeadTag('meta', null, null, ["property" => "og:type",
                                                  "content" => "article"]));
			$this->app->router->response()->addHeadTag(
				new CHeadTag('meta', null, null, ["property" => "og:title",
                                                  "content" => $this->dataBag->entity->postTranslation->getFirst()->title]));
			$this->app->router->response()->addHeadTag(
				new CHeadTag('meta', null, null, ["property" => "og:image",
                                                  "content" => $this->helper->image($this->dataBag->entity->postTranslation->getFirst()->coverImage)]));
			$this->app->router->response()->addHeadTag(
				new CHeadTag('meta', null, null, ["property" => "article:author",
                                                  "content" =>$this->dataBag->entity->author]));


		} catch (\Throwable $e) {
		}

		$this->view->pass('app', $this->helper);
		$this->view->pass('data', $this->dataBag);
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