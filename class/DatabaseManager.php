<?php

/**
 * Description of DatabaseManager
 *
 * @author Jakub Kubacki
 */
class DatabaseManager
{

	private $mysql;

	public function __construct(Mysql $mysql)
	{
		$this->mysql = $mysql;
	}

	public function getItems($constrains = 'WHERE 1')
	{
		$query = "
		SELECT i.id ,
		`client_id` ,
		i.name ,
		`description` ,
		`start_date` ,
		`due_date` ,
		`active` ,
		`images`,
		c.name as client_name
		FROM item i LEFT JOIN client c
		ON i.client_id = c.id
		$constrains";
		$result = $this->mysql->select($query);
		$items = array();
		for ($i = 0; $i < count($result); $i++) {
			$r = $result[$i];
			$items[] = $this->createItem($r);
		}
		return $items;
	}

	public function addItem(Item $item)
	{
		$query = "
		INSERT INTO `item` (
		`id` ,
		`client_id` ,
		`name` ,
		`description` ,
		`start_date` ,
		`due_date` ,
		`active` ,
		`images`
		)
		VALUES (
		NULL , 
		'" . addslashes($item->getClientId()) . "',
		'" . addslashes($item->getName()) . "',
		'" . addslashes($item->getDescription()) . "', 
		CURRENT_TIMESTAMP ,
		'" . addslashes($item->getDueDate()) . "',
		'" . addslashes($item->getActive()) . "',
		'" . addslashes(serialize($item->getImages())) . "'
		);
		";
		$this->mysql->query($query);
		return $this->mysql->insert_id;
	}

	public function createItem($r)
	{
		$item = new Item();
		$item->setId($r['id']);
		$item->setClientId($r['client_id']);
		$item->setClientName($r['client_name']);
		$item->setName($r['name']);
		$item->setDescription($r['description']);
		$item->setStartDate($r['start_date']);
		$item->setDueDate($r['due_date']);
		$item->setActive($r['active']);
		$item->setImages(unserialize($r['images']));
		$item->setOffers($this->getOffers($item->getId()));
		return $item;
	}

	public function removeItem($id)
	{
		$query = "DELETE FROM `item` WHERE `id` = '$id'";
		$this->mysql->query($query);
	}

	public function getOffers($itemId)
	{
		$query = "
			SELECT o.id, o.item_id, o.client_id, o.item_id, o.description, o.images, o.accepted, c.name as client_name
			FROM offer o LEFT JOIN client c
			ON o.client_id = c.id
			WHERE `item_id` = $itemId
		";
		$result = $this->mysql->select($query);
		$offers = array();
		for ($i = 0; $i < count($result); $i++) {
			$r = $result[$i];
			$offers[] = $this->createOffer($r);
		}
		return $offers;
	}

	public function addOffer(Offer $offer)
	{
		$query = "
		INSERT INTO `offer` (
		`id` ,
		`client_id` ,
		`item_id` ,
		`description` ,
		`images`
		)
		VALUES (
		NULL ,
		'" . addslashes($offer->getClientId()) . "',
		'" . addslashes($offer->getItemId()) . "',
		'" . addslashes($offer->getDescription()) . "',
		'" . addslashes(serialize($offer->getImages())) . "'
		);";
		$this->mysql->query($query);
	}

	public function removeOffer($id)
	{
		$query = "DELETE FROM `offer` WHERE `id` = '$id'";
		$this->mysql->query($query);
	}

	public function createOffer($r)
	{
		$offer = new Offer();
		$offer->setClientId($r['client_id']);
		$offer->setItemId($r['item_id']);
		$offer->setClientName($r['client_name']);
		$offer->setId($r['id']);
		$offer->setImages(unserialize($r['images']));
		$offer->setDescription($r['description']);
		$offer->setAccepted($r['accepted']);
		return $offer;
	}

	public function getClients()
	{
		$query = "SELECT * FROM `client`";
		return $this->mysql->select($query);
	}

}

?>
