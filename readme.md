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
            string name
            string streetNum
            string streetName
            string city
            string country
            int userId FK
        }

        Category {
            int id PK
            string name
        }

        Product {
            int id PK
            string name
            string description
            float price
            string photo
            int categoryId FK
        }

        Review {
            int id PK
            int rate
            string text
            date date
            int userId FK
            int productId FK
        }

        Order {
            int id PK
            date date
            float price
            string status
            int userId FK
        }

        OrderLine {
            int id PK
            int quantity
            float price
            int productId FK
            int orderId FK
        }

        User ||--o| Customer : has
        User ||--|{ CustomerAddress : has
        User ||--o{ Review : has
        User ||--o{ Order : has
        Product }o--|| Category : has
        Product ||--o{ Review : has
        OrderLine ||--|| Product : has
        OrderLine ||--|| Order : has

 ```