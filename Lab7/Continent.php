<?php
	
	class Continent extends DB
	{
		protected $id_continent;
		private $continent;
		protected $table = "continents"; 

		public function __constructor($id = null, $continent="") {
			$this->id_continent = $id;
			$this->continent = $continent;	
		}

		public function setContinent($continent) {
			$res = parent::select(" WHERE continents.`id_continent` =".$continent);
			$row = $res->fetch_assoc();
			$this->continent = $row['continent'];
			$this->id_continent = $row['id_continent'];
		}
	
		public function getId() {
			return $this->id_continent;
		}
		
		public function getContinent() {
			return $this->continent;
		}
	}

?>