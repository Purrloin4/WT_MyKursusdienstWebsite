<?php

 require_once 'php/DataBase.php';
class Feedback
{
    private ?int $id = null;
    private string $author;
    private string $text;
    private DateTime $created;
    private $db;

    public function __construct($author, $text)
    {
        $this->author = $author;
        $this->text = $text;
        $this->db = (new Database())->getConnection();
    }

    public function save(): Feedback
    {
        $db = (new Database())->getConnection();
        $statement = $db->prepare("INSERT INTO feedback (author, text, created) VALUES (:author, :text, :created)");
        $statement->execute([
            'author' => $this->getAuthor(),
            'text' => $this->getText(),
            'created' => date('Y-m-d H:i:s')
        ]);

        $this->id = $db->lastInsertId();
        $this->created = new DateTime();

        return $this;
    }

    static function getAllFeedback(): array
    {
        $db = (new Database())->getConnection();
        $stm = $db->prepare('SELECT ID, text, author, created FROM feedback');
        $stm->execute();
        $result = array();
        while ($item = $stm->fetch()) {
            $feedback = new Feedback($item['author'], $item['text']);
            $feedback->setId($item['ID']);
            $feedback->setCreated(new DateTime($item['created']));
            $result[] = $feedback;
        };
        return $result;
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }


}