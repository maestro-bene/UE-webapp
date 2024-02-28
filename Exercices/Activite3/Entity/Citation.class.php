<?php
/**
 * Represents a citation from an author.
 *
 * This class manages the details of a citation, including its text, the date it was made,
 * and a reference to the author object. Private properties are prefixed with an underscore
 * to denote their visibility clearly.
 *
 * @package Entity
 */

declare(strict_types=1);

/**
 * Class Citation
 *
 * Represents a citation, including its text, publication date, and author.
 *
 * @package Entity
 */
class Citation
{
    /**
     * The content of the citation.
     *
     * @var string
     */
    private string $_text;

    /**
     * The publication date of the citation.
     *
     * @var string
     */
    private string $_date;

    /**
     * The author corresponding to the citation
     *
     * @var Author
     */
    private Author $_author;

    /**
     * Constructor for the Citation class.
     *
     * @param string $text   The text of the citation.
     * @param string $date   The date the citation was made.
     * @param Author $author The author of the citation.
     */
    public function __construct(string $text, string $date, Author $author)
    {
        $this->_text = $text;
        $this->_date = $date;
        $this->_author = $author;
    }

    /**
     * Retrieves the text of the citation.
     *
     * @return string The text of the citation.
     */
    public function getText(): string
    {
        return $this->_text;
    }

    /**
     * Retrieves the date the citation was made.
     *
     * @return string The date of the citation.
     */
    public function getDate(): string
    {
        return $this->_date;
    }


    /**
     * Retrieves the author of the citation.
     *
     * @return Author The author of the citation.
     */
    public function getAuthor(): Author
    {
        return $this->_author;
    }
}
