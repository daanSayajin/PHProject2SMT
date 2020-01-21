<?php
class Product {
    private $name;
    private $description;
    private $price;
    private $discount;
	private $isProductOfTheMonth;
	private $imagePath;
	private $clicks;
	private $status;
	private $id;

    public function __construct($name, $description, $price, $discount, $isProductOfTheMonth, $imagePath = null, $clicks = null, $status = true, $id = '') {
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
		$this->discount = $discount;
		$this->isProductOfTheMonth = $isProductOfTheMonth;
		$this->imagePath = $imagePath;
		$this->clicks = $clicks;
		$this->status = $status;
        $this->id = $id; 
    }

    public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function getDiscount() {
		return $this->discount;
	}

	public function setDiscount($discount) {
		$this->discount = $discount;
	}

	public function getIsProductOfTheMonth() {
		return $this->isProductOfTheMonth;
	}

	public function setIsProductOfTheMonth($isProductOfTheMonth) {
		$this->isProductOfTheMonth = $isProductOfTheMonth;
	}

	public function getImagePath() {
        return $this->imagePath;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
	}
	
	public function getClicks() {
        return $this->clicks;
    }

    public function setClicks($clicks) {
        $this->clicks = $clicks;
    }

	public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}
?>