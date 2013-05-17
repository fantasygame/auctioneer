<?php

/**
 * Description of Offer
 *
 * @author Jakub Kubacki
 */
class Offer
{

	private $id;
	private $clientId;
	private $clientName;
	private $itemId;
	private $description;
	private $images;
	private $accepted;

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

	public function getItemId()
	{
		return $this->itemId;
	}

	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getImages()
	{
		return $this->images;
	}

	public function setImages($images)
	{
		$this->images = $images;
	}

	public function getAccepted()
	{
		return $this->accepted;
	}

	public function setAccepted($accepted)
	{
		$this->accepted = $accepted;
	}

}

?>
