<?php

class Government extends DB
{
	protected $id_government;
	private $government;
	protected $table = "government";

	public function __constructor($id=null, $government="") {
		$this->id_government=$id;
		$this->government=$government;
		
	}

	public function setGovernment($government) {
		$res = parent::select("WHERE `id_government` = ".$government);
		if($res){
			$row = $res->fetch_assoc();
			$this->government = $row['government'];
			$this->id_government = $row['id_government'];
		}
	}

	public function getId() {
		return $this->id_government;
	}

	public function getGovernment() {
		return $this->government;
	}

	public function toString() {
		return $this->government."	".$this->id_government;
	}

}

?>