<?php
/**
 * Represents an author of citations.
 *
 * This class manages the details of an author, including their full name and birth year.
 * Private properties are prefixed with an underscore to denote their visibility clearly.
 *
 * @package Entity
 */

declare(strict_types=1);

/**
 * Class Author
 *
 * Represents an author of a citation.
 *
 * @package Entity
 */
class Author
{
    /**
     * The first name of the author.
     *
     * @var string
     */
    private string $_firstName;

    /**
     * The last name of the author.
     *
     * @var string
     */
    private string $_lastName;

    /**
     * The birth year of the author.
     *
     * @var int
     */
    private int $_birthYear;

    /**
     * Constructor for the Author class.
     *
     * @param string $fullName  The full name of the author in the format
     *                          "first name | last name".
     * @param int    $birthYear The birth year of the author.
     */
    public function __construct(string $fullName, int $birthYear)
    {
        list($this->_firstName, $this->_lastName) = explode(' | ', $fullName);
        $this->_birthYear = $birthYear;
    }

    /**
     * Retrieves the full name of the author.
     *
     * @return string The full name of the author.
     */
    public function getFullName(): string
    {
        return $this->_firstName . ' ' . $this->_lastName;
    }

    /**
     * Retrieves the first name of the author.
     *
     * @return string The first name of the author.
     */
    public function getFirstName(): string
    {
        return $this->_firstName;
    }

    /**
     * Retrieves the last name of the author.
     *
     * @return string The last name of the author.
     */
    public function getLastName(): string
    {
        return $this->_lastName;
    }

    /**
     * Retrieves the birth year of the author.
     *
     * @return int The birth year of the author
     */
    public function getBirthYear(): int
    {
        return $this->_birthYear;
    }
}
