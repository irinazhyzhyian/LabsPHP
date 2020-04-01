<?php

class Language extends DB
{
	private $id_language;
	private $language;
	protected $table = "languages";

	public function __constructor($id=null, $language="") {
		$this->id_language=$id;
		$this->language=$language;
	}

	public function setLanguage($language) {
		$res = parent::select("WHERE `id_language` = ".$language);
		if($res) {
			$row = $res->fetch_assoc();
			$this->language = $row['language'];
			$this->id_language = $row['id_language'];
		}
	}

	public function getId() {
		return $this->id_language;
	}

	public function getLanguage() {
		return $this->language;
	}
}

?>