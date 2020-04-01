<?php

class CountryLanguage extends DB
{
	private $id_country_language;
	protected $language;
	protected $country;

	protected $table = "country_language";
	
	public function __construct($language, $country) {
		$this->language = $language;
		$this->country  = $country;
	}

	public function setLanguage($language) {
		$this->language = $language;
	}

	public function setCountry($country) {
		$this->country  = $country;
	}

	public function insert() {
		if($this->language->getId()!="" && $this->country->getId()!=""){
		$insertQwery = "INSERT INTO ".$this->table."(`id_language`, `id_country`) values(".$this->language->getId().",".$this->country->getId().")";
        $query = parent::getInstance()->getConnection()->query($insertQwery);
		}
	}

}

?>