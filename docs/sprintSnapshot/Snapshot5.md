# Sprint 5 (28/02/2025 - 21/03/2025)


Aquest sprint ens hem enfocat a tenir establerta la web en el domini i tenir la BD ja disponible. A part, hem millorat bastant la web fent ús dels apis, tailwind css y del backend amb el php laravel (blade).

En aquest sprint teniem que fer-hi la presentació de mitjan projecte i la presentació al client juntament amb el Ismab. És per això que el nostre desenvolupament en aquest sprint ha sigut principalment en desenvolupar la web per una millor mostra. 

Les millores en aquest sprint són:

### Multimenu:
Una implementació ha sigut aquest multimenu on aportem les views d'"Herramientas" tant com plaques, bateries o inversors...
![image](https://github.com/user-attachments/assets/10f5d474-8670-407b-960b-a337f94f1023)


### Inversors:
Com hem explicat abans, aquesta és la view d'inversors on té bàsicament el crud. (Encara no funciona completament, ja que queda validar les dades completament i fer-hi l'opció d'editar).
Es compon d'un modal principal on té un formulari POST per pujar-hi les dades a la BD i mostrar-les en la taula.
![image](https://github.com/user-attachments/assets/9902cdb2-5bf5-440c-8b88-0230d8e234c2)
El modal de creació també té un altre modal on se seleccionen els fabricants o es creen (També des de la BD).
![image](https://github.com/user-attachments/assets/917c4d46-e525-4505-ae34-4efdae74ed09)
Així quedaria la taula després de crear un inversor. Com podem observar té també els botons d'editar i eliminar, encara que només funciona el d'eliminar.
![image](https://github.com/user-attachments/assets/b805d23c-ed95-40ed-8357-245fe714a56f)
El botó d'eliminar genera aquest altre modal on es valida l'eliminació de dades ficant-li el nombre de l'inversor.
![image](https://github.com/user-attachments/assets/dc0ccb3d-ff9c-45bd-b9eb-4bb833798b07)


### Pagina d'inici:
Aquesta és la nostra pàgina d'inici terminat. És la pàgina que es mostra en accedir-hi a la web. Està basada en la pàgina de Lenium. L'objectiu és poder veure d'on prové el projecte i té les opcions d'inscriure (login) i registrar-te. 
![image](https://github.com/user-attachments/assets/08d6911b-7248-4fa3-8fb2-32e4ce8c262b)



### Obstacles:
Hem implementat l'opció de poder-hi treure de l'àrea principal l'àrea dels obstacles. Ho fem generant un altre polígon que en crear-se l'hi resta la seva àrea al total. També tens l'opció d'eliminar-los, passant la seva àrea a l'àrea total.
![image](https://github.com/user-attachments/assets/655d18f7-d74d-4777-b0e8-718557731925)


### Numero de plaques:
Amunt dels obstacles trobem el nombre de plaques que hi càpiguen en l'àrea seleccionada. Funciona de manera que calcula l'àrea seleccionada i la divideix entre l'àrea del panel / placa creada en la view de plaques. 
![image](https://github.com/user-attachments/assets/181ab626-d20e-4098-970a-7cc28ca54cbe)


### Llistat de plaques
Aquest és el nostre llistat de plaques on les mostrem i les afegim. La intenció és que per als pròxims sprints poder-hi importar-les i mostrar un llistat de les plaques afegides automàticament en la BD. També ho volem implementar als inversors i a les bateries.
![image](https://github.com/user-attachments/assets/2eb2c125-25df-4c68-83d9-e21bd39fccb0)
Aquest és el formulari de creació de les plaques, on s'afegeix a la BD i es mostra en la view.
![image](https://github.com/user-attachments/assets/525df154-687a-4256-983e-4ae735238913)
I aquest és el resultat:
![image](https://github.com/user-attachments/assets/e4508100-2391-4095-9ff3-13696f1b917f)





