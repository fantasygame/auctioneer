<?php

/**
 * Description of Item
 *
 * @author Jakub Kubacki
 */
class Item
{

	private $id;
	private $clientId;
	private $clientName;
	private $name;
	private $description;
	private $startDate;
	private $dueDate;
	private $active;
	private $images;
	private $offers;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getClientId()
	{
		return $this->clientId;
	}

	public function setClientId($clientId)
	{
		$this->clientId = $clientId;
	}

	public function getClientName()
	{
		return $this->clientName;
	}

	public function setClientName($clientName)
	{
		$this->clientName = $clientName;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getStartDate()
	{
		return $this->startDate;
	}

	public function setStartDate($startDate)
	{
		$this->startDate = $startDate;
	}

	public function getDueDate()
	{
		return $this->dueDate;
	}

	public function setDueDate($dueDate)
	{
		$this->dueDate = $dueDate;
	}

	public function getActive()
	{
		return $this->active;
	}

	public function setActive($active)
	{
		$this->active = $active;
	}

	public function getImages()
	{
		return $this->images;
	}

	public function setImages($images)
	{
		$this->images = $images;
	}

	public function getOffers()
	{
		return $this->offers;
	}

	public function setOffers($offers)
	{
		$this->offers = $offers;
	}

}

?>
