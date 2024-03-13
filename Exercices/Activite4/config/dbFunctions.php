<?php

require_once 'db-config.php'; // Include your database configuration file

function getCitationsByAuthor($author_id)
{
    global $pdo;
    $sql = "SELECT * FROM citation WHERE author_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$author_id]);
    return $stmt;
}

function getTotalCitationCount()
{
    global $pdo;
    $sql = "SELECT COUNT(*) AS total_count FROM citation";
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_ASSOC)['total_count'];
}

function getCitationCountForAuthor($author_id)
{
    global $pdo;
    $sql = "SELECT COUNT(*) AS author_citation_count FROM citation WHERE author_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$author_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['author_citation_count'];
}

function getCitationsOrderedByCreationDate()
{
    global $pdo;
    $sql = "SELECT * FROM citation ORDER BY creation_date";
    $stmt = $pdo->query($sql);
    return $stmt;
}

function getCitationsOrderedByDate()
{
    global $pdo;
    $sql = "SELECT * FROM citation ORDER BY `date`, creation_date";
    $stmt = $pdo->query($sql);
    return $stmt;
}

function getCitationsOrderedByAuthor()
{
    global $pdo;
    $sql = "SELECT * FROM citation ORDER BY author_id";
    $stmt = $pdo->query($sql);
    return $stmt;
}

function findAuthorById($author_id)
{
    global $pdo;
    $sql = "SELECT * FROM author WHERE author_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$author_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getCitationsByTimeRange($start_date, $end_date, $order_by = 'creation_date ASC')
{
    global $pdo;
    $sql = "SELECT * FROM citation WHERE creation_date BETWEEN '$start_date' AND '$end_date' ORDER BY $order_by";
    $stmt = $pdo->query($sql);
    return $stmt;
}

/**
 * Gets the ID of an author based on their details.
 *
 * @param PDO $pdo The PDO database connection
 * @param string $firstName The first name of the author
 * @param string $lastName The last name of the author
 * @param int $birthYear The birth year of the author
 * @return int|null The ID of the author, or null if not found
 */
function getAuthorId(string $firstName, string $lastName, int $birthYear): ?int
{
    global $pdo;
    try {
        // Prepare SQL statement
        $stmt = $pdo->prepare("SELECT author_id FROM author WHERE first_name = :first_name AND last_name = :last_name AND birth_year = :birth_year");

        // Bind parameters
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':birth_year', $birthYear);

        // Execute statement
        $stmt->execute();

        // Fetch the author ID
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return (int)$result['author_id'];
        } else {
            return null;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

/**
 * Adds a new citation to the database, creating the author if not found.
 *
 * @param PDO $pdo The PDO database connection
 * @param string $text The text of the citation
 * @param string $date The creation date of the citation
 * @param string $firstName The first name of the author
 * @param string $lastName The last name of the author
 * @param int $birthYear The birth year of the author
 * @return bool True if the citation is successfully added, false otherwise
 */
function addCitation(string $text, string $date, string $firstName, string $lastName, int $birthYear): bool
{
    global $pdo;
    try {
        // Check if the author exists
        $authorId = getAuthorId($firstName, $lastName, $birthYear);

        // If the author does not exist, create a new author
        if (!$authorId) {
            createAuthor($firstName, $lastName, $birthYear);
            // Get the ID of the newly created author
            $authorId = getAuthorId($firstName, $lastName, $birthYear);
        }

        // Insert the citation into the database
        $stmt = $pdo->prepare("INSERT INTO citation (text, date, author_id) VALUES (?, ?, ?)");
        $stmt->execute([$text, $date, $authorId]);

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

/**
 * Creates a new author in the database.
 *
 * @param PDO $pdo The PDO database connection
 * @param string $firstName The first name of the author
 * @param string $lastName The last name of the author
 * @param int $birthYear The birth year of the author
 * @return bool True if the author is successfully created, false otherwise
 */
function createAuthor(string $firstName, string $lastName, int $birthYear): bool
{
    global $pdo;
    try {
        // Insert the new author into the database
        $stmt = $pdo->prepare("INSERT INTO author (first_name, last_name, birth_year) VALUES (?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $birthYear]);

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
