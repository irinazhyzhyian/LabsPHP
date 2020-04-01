<?php
 
class Country extends DB
{
	private $id_country;
	private $country_name;
	private $continent;
	private $government;
	private $population;
	private $square;

	protected $table = "countries";


	public function __construct($name, $continent, $gov, $pop, $s) {
		$this->country_name = $name;
		$this->continent = $continent;
		$this->government = $gov;
		$this->population = $pop;
		$this->square = $s;
	}

	public function setCountryName($name) {
		$this->country_name = $name;
	}

	public function getCountryName() {
		echo $this->country_name;
		return $this->country_name;
	}

	public function setContinent($continent) {
		$this->continent = $continent;
	}

	public function getContinent() {
		return $this->continent;
	}

	public function setGovernment($government) {
		$this->government = $government;
	}

	public function getGovernment() {
		return $this->government;
	}

	public function setPopulation($population) {
		$this->population = $population;
	}

	public function getPopulation() {
		return $this->population;
	}

	public function setSquare($square) {
		$this->square = $square;
	}

	public function getSquare() {
		return $this->square;
	}

	public function getId() {
		return $this->id_country;
	}

	public function insert()
    {	
		
		$id_continent = $this->continent->getId();
		$id_government=$this->government->getId();
       
        $insertQwery = "INSERT INTO ".$this->table."(`country_name`, `id_continent`, `id_government`, `population`, `square`) VALUES ('".$this->country_name."',".$id_continent
					.",".$id_government.",".$this->population.",".$this->square.")";
		parent::getInstance()->getConnection()->query($insertQwery);

		$idquery = "SELECT id_country FROM countries WHERE country_name LIKE '".$this->country_name."'";
		$res = parent::getInstance()->getConnection()->query($idquery);
		$row = $res->fetch_assoc();
		$this->id_country = $row['id_country'];

	}
	

}

?>