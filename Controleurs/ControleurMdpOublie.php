<?php
class ControleurMdpOublie
{
	public function defautAction($params, $post)
	{
		Vue::montrer('mdpOublie', []);
	}
}