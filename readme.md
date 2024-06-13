# Site de E-commerce
## Réflexion autour des entités
Nous allons concevoir notre Diagramme relationnel d'entité (erDiagram).

- de quelles entités avons nous besoin ?
- qu'elles sont les relations entre ces entités ?

### Par étape :

- fournir une liste de toutes les entités
- penser les propriétés de ces entités
- définir les relations entre chaque entités
### Étape 1 : fournir une liste de toutes les entités

- User
- Customer
- CustomerAddress
---
- Category
- Product
- Review
---
- Order
- OrderLine
    - product
    - qty
    - price
- Payment
 
### Étape 2 et 3 : A vous de pensez les propriétés et les relations



## Mermaid
ℹ️ Prise en main de Mermaid.
https://mermaid.js.org/syntax/entityRelationshipDiagram.html

Nous allons définir ensuite notre Diagram relation d'entités à l'aide Mermaid.

- Créer un fichier readme.md
- Structurer le document avec un chapitre Diagramme relationnel d'entités
- Concevoir le Diagram


 ⚠️ Le fichier readme.md sera utilisé comme documentation de notre projet.
 Il sera placé à la racine de votre projet et comportera en plus les information pour l'installation et la configuration de votre projet.

 ## Diagramme relationnel d'entités

 ```mermaid
    erDiagram
        User {
            int id PK
            string(255) email
            string password
            array role
            datetime createdAt
            datetime modifiedAt
        }

        Customer {
            int id PK
            string(100) firstName
            string(100) lastName
            string(100) phone
            datetime birthdate
            array customerAddresses
        }

        CustomerAddress {
            int id PK
            string(100) name
            string(255) line1
            string(255) line2
            string(50) zipCode
            string city
            string country
            array type
        }


        Product {
            int id PK
            string(100) name
            text description
            float price
            int stock
            string(100) slug
            datetime createdAt
            datetime modifiedAt
        }

        Tva {
            int id PK
            string(100) name
            float value
            datetime createdAt
            datetime modifiedAt
        }

        ProductImage {
            int id PK
            string(100) name
            string(255) file
            datetime createdAt
            datetime modifiedAt
        }

        Category {
            int id PK
            string name
            text description
            string(100) slug
            datetime createdAt
            datetime modifiedAt
        }

        Review {
            int id PK
            int review
            text content
            datetime createdAt
            datetime modifiedAt
        }

        Order {
            int id PK
            string(255) orderNumber
            string(100) status
            datetime createdAt
            datetime shippedAt
        }

        OrderLine {
            int id PK
            int quantity
            float price
            float tva
        }

        Payment {
            int id PK
            string(255) type
            float amount
            datetime createdAt
        }

        User ||--o| Customer : is
        User ||--|{ CustomerAddress : has
        Customer ||--o| Review : has
        Product ||--o| Review : has
        Product }o--|| Tva : has
        Product ||--|{ ProductImage : has
        Product }o--|{ Category : inside
        OrderLine }|--|| Order : inside
        Payment }o--|| Order : isPaid
        Customer ||--o{ Order : has
        OrderLine }|--|| Product : has

 ```


 ## Installation

 ### Création du projet

 ```bash
    symfony new my_project_directory --version="7.1.*" --webapp
 ```

### Création de la BDD
- Création d'un fichier .env.local
- Ajout de la ligne :
 ```php
    DATABASE_URL="mysql://root:root@127.0.0.1:3306/ecommerce?serverVersion=5.7.24&charset=utf8mb4"
 ```

 ### Création des entités
 ```bash
    php bin/console make:entity
 ```

 ### Création des migrations
 Permet de créer les différentes des tables dans la BDD
  ```bash
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate
 ```


### Création d'un formulaire de connexion
Installation du bundle security
  ```bash
    composer require symfony/security-bundle
 ```

 ### Création d'un formulaire d'inscription
Création du formulaire
```bash
    php bin/console make:registration-form
```

Installation du bundle pour l'email de confirmation
 ```bash
     composer require symfonycasts/verify-email-bundle
```

Installation de mailer
 ```bash
    composer required symfony/mailer
```

Ajouter le mailer DSN dans .env.local
```php
    // Pour MailHog
    MAILER_DSN=smtp://localhost:1025 
```

Commenter la ligne suivante pour éviter d'enregistrer les mails dans la table messenger_messages
```php
    Symfony\Component\Mailer\Messenger\SendEmailMessage: async
```

Créer un formulaire pour le customer
```bash
    php .\bin\console make:form 
```


Dans le registrationFormType.php ajouter la ligne suivante pour y intégrer le customerType.php

```php
    ->add('customer', CustomerType::class, [
        'label' => false
    ]) 
```

### Création de fixtures
```bash
    composer require --dev orm-fixtures
```

Ajouter cette fixture
```php
     public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $categories = [];

        for ($j = 0; $j < 150; $j++) {
            $category = new Category();

            $category->setName($faker->realTextBetween(10, 20));

            $categories[] = $category;

            $manager->persist($category);
        }

        for ($i = 0; $i < 150; $i++) {
            $product = new Product();

            $product->setName($faker->realTextBetween(10, 30))
                ->setDescription($faker->realTextBetween(150, 300))
                ->setPrice($faker->randomFloat(2, 10, 300))
                ->setStock($faker->randomDigit());



            $nbCategory = random_int(1, 10);
            for ($k = 0; $k < $nbCategory; $k++) {
                shuffle($categories);
                $product->addCategory($categories[0]);
            }


            for ($l = 0; $l < 10; $l++) {
                $image = new ProductImage();
                $image->setName($faker->realTextBetween(10, 30))
                ->setFile("https://picsum.photos/id/". $faker->numberBetween(1, 900)."/1024")
                ->setProduct($product);

                $manager->persist($image);
            }

            $manager->persist($product);
        }

        $manager->flush();

    }
```

Installer Faker
```bash
    composer require fakerphp/faker
```