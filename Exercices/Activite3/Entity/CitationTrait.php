<?php
/**
 * This trait is made to initialize citations.
 *
 * @package Entity
 */

declare(strict_types=1);

/**
 * A trait to share initialization of citations.
 */
trait CitationTrait
{
    /**
     * Initializes the system with predefined data and returns an array
     * of Citation objects.
     *
     * This function simulates data that might typically be retrieved from a database.
     * It's used here for demonstration purposes to populate the system with
     * initial data.
     *
     * @return array An array of Citation objects.
     */
    public function main(): array
    {
        $author1 = new Author("Jane | Doe", 1980);
        $author2 = new Author("John | Smith", 1975);
        $author3 = new Author("Jean | Dujardin", 1910);
        // More authors can be added as needed

        $citations = [
            new Citation(
                'To be or not to be, that is the question.',
                '2023-01-01',
                $author1
            ),
            new Citation(
                'The only thing we have to fear is fear itself.',
                '2023-01-02',
                $author2
            ),
            new Citation(
                'C\'est curieux chez les marins ce besoin de faire des phrases.',
                '2003-04-18',
                $author3
            ),
            new Citation(
                'J\'aime me beurrer la biscotte.',
                '2014-06-29',
                $author3
            ),
            new Citation(
                'Les chinois, une grande civilisation. Pas pratique pour telephoner mais une grande civilisation.',
                '2005-05-30',
                $author3
            ),
            // More citations can be added as needed
        ];
        return $citations;
    }

    /**
     * Checks if an author exists based on first name, last name, and birth year.
     * If found, returns the Author object; otherwise, returns null.
     *
     * @param string $firstName The first name of the author.
     * @param string $lastName  The last name of the author.
     * @param int    $birthYear The birth year of the author.
     *
     * @return Author|null       The Author object if found, otherwise null.
     */
    public function findAuthor(string $firstName, string $lastName, int $birthYear): ?Author
    {
        // Loop through existing authors to find a match
        foreach ($this->main() as $citation) {
            $author = $citation->getAuthor();
            if ($author->getFirstName() === $firstName && $author->getLastName() === $lastName && $author->getBirthYear() === $birthYear) {
                return $author;
            }
        }
        return null; // Author not found
    }
}
