# sae2-01
# Auteurs
Damien FAY (fay0026) et Paco JACQUEMAIN (jacq0223)

# Fonctionnalités
## Navigation
L'ensemble des scripts et classes implémentés permet aux navigateurs depuis la liste des films, de les rechercher en triant par leur genre,
mais aussi de cliquer sur l'un d'entre eux, où ils seront amenés à la page détaillant ce derniers,
depuis cette pages, ils pourront consulter tous les détails des films,
incluant le nom, le poster, la date de sortie, le slogan,
le résumé, le titre et la langue original, ainsi que les acteurs ayant un rôle
dans celui-ci. De là, ils pourront cliquer sur les acteurs pour accéder à leur pages,
les présentant avec leur photo, date et naissance et/ou de décès,
lieu de naissance... et les films où ils ont joué.

## Edition
Il est aussi possible d'éditer les données de la base de données, donc d'ajouter,
modifier, ou supprimer les acteurs et les films.

# Programmes
## Ressources
- [ ] defaultActor.png
- [ ] defaultMovie.png
## Classes
### Database
- [ ] MyPdo.php

### Entity
- [ ] Actor.php
- [ ] Cast.php
- [ ] Genre.php
- [ ] Image.php
- [ ] Movie.php

### Collection
- [ ] ActorCollection.php
- [ ] CastCollection.php
- [ ] GenreCollection.php 
- [ ] ImageCollection.php
- [ ] MovieCollection.php

### Exception
- [ ] EntityNotFound.php
- [ ] ParameterException.php

## Html
- [ ] MovieWebPage.php
- [ ] StringEscaper.php
- [ ] WebPage.php

### css
- [ ] style.css

### Form
- [ ] MovieForm.php

## Scripts
### bin
- [ ] run-server.bat
- [ ] run-server.sh
- [ ] run-test-server.bat

### public
- [ ] index.php

#### admin
- [ ] artist-delete.php
- [ ] movie-form.php
- [ ] movie-save.php

#### database
- [ ] DetailsActor.php
- [ ] DetailsFilm.php
- [ ] ImageActor.php
- [ ] ImageMovie.php
- [ ] ListeFilms.php
- [ ] TrieFilms.php

# Composer
- [ ] composer.json
- [ ] composer.lock
