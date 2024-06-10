# Site de E-commerce
## Réflexion autour des entités
Nous allons concevoir notre Diagramme relationnel d'entité (erDiagram).

- de quelles entités avons nous besoin ?
- qu'elles sont les relations entre ces entités ?

### Par étape :

- fournir une liste de toutes les entités
- penser les propriétés de ces entités
- définir les relations entre chaque entités
---
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