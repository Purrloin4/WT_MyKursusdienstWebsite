<?php

class Feedback
{
    private ?int $id = null;
    private string $author;
    private string $text;
    private DateTime $created;

    public function __construct($author, $text, $id = null, $created)
    {
        $this->author = $author;
        $this->text = $text;
        $this->id = $id;
        $this->created = $created;
    }

    public function save() : Feedback
    {
        $statement = $db->prepare("INSERT INTO feedback (author, text, created) VALUES (:author, :text, :created)");
        $statement->execute([
            'author' => $this->getAuthor(),
            'text' => $this->getText(),
            'created' => date('Y-m-d H:i:s')
        ]);

        $this->id = $db->lastInsertId();
        $this->created = date('Y-m-d H:i:s');
    }

    static function getAllFeedback() : array
    {
        $stm = $db->prepare('SELECT ID, text, author, created FROM feedback');
        $stm->execute();
        $result = array();
        while ($item = $stm->fetch()) {
            $feedback = new Feedback($item['text'], $item['author']);
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