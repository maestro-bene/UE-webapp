<?php

trait DbCitationTrait
{
    public function main(): void
    {
        require_once 'db-config.php'; // Include your database configuration file
        global $pdo;

        foreach ($this->getCitationsData() as $citationData) {
            $author = $citationData['author'];
            $text = $citationData['text'];
            $date = $citationData['date'];

            // Check if the author exists in the database
            $authorId = $this->findOrCreateAuthor($author['first_name'], $author['last_name'], $author['birth_year']);

            // Insert citations into the database
            $this->insertCitation($citationData, $authorId);
        }
    }

    private function getCitationsData(): array
    {
        return [
            [
                'text' => 'To be or not to be, that is the question.',
                'date' => '2023-01-01',
                'author' => ['first_name' => 'Jane', 'last_name' => 'Doe', 'birth_year' => 1980]
            ],
            [
                'text' => 'The only thing we have to fear is fear itself.',
                'date' => '2023-01-02',
                'author' => ['first_name' => 'John', 'last_name' => 'Smith', 'birth_year' => 1975]
            ],
            [
                'text' => 'C\'est curieux chez les marins ce besoin de faire des phrases.',
                'date' => '2003-04-18',
                'author' => ['first_name' => 'Jean', 'last_name' => 'Dujardin', 'birth_year' => 1910]
            ],
            [
                'text' => 'J\'aime me beurrer la biscotte.',
                'date' => '2014-06-29',
                'author' => ['first_name' => 'Jean', 'last_name' => 'Dujardin', 'birth_year' => 1910]
            ],
            [
                'text' => 'Les chinois, une grande civilisation. Pas pratique pour telephoner mais une grande civilisation.',
                'date' => '2005-05-30',
                'author' => ['first_name' => 'Jean', 'last_name' => 'Dujardin', 'birth_year' => 1910]
            ]
            // Add more citation data as needed
        ];
    }

    private function findOrCreateAuthor(string $firstName, string $lastName, int $birthYear): int
    {
        global $pdo; // Access the PDO object from dbconfig.php

        // Check if the author already exists in the database
        $stmt = $pdo->prepare("SELECT author_id FROM author WHERE first_name = ? AND last_name = ? AND birth_year = ?");
        $stmt->execute([$firstName, $lastName, $birthYear]);
        $existingAuthor = $stmt->fetchColumn();

        // If the author doesn't exist, insert them into the database
        if (!$existingAuthor) {
            $stmt = $pdo->prepare("INSERT INTO author (first_name, last_name, birth_year) VALUES (?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $birthYear]);
            return $pdo->lastInsertId(); // Return the ID of the newly inserted author
        }

        return $existingAuthor; // Return the ID of the existing author
    }

    private function insertCitation(array $citation, int $authorId): void
    {
        global $pdo; // Access the PDO object from dbconfig.php

        // Check if the citation already exists based on text
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM citation WHERE LOWER(TRIM(text)) = LOWER(TRIM(?))");
        $stmt->execute([$citation['text']]);
        $existingCitationCount = (int) $stmt->fetchColumn();

        if ($existingCitationCount === 0) {
            // Citation does not exist, insert it into the database
            $stmt = $pdo->prepare("INSERT INTO citation (text, date, author_id) VALUES (?, ?, ?)");
            $stmt->execute([$citation['text'], $citation['date'], $authorId]);
        }
    }
}
