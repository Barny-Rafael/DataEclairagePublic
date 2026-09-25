<?php

class ControleurPlanSite{

	public function defautAction($params, $post)
	{
		Vue::montrer('planSite', []);
	}
}