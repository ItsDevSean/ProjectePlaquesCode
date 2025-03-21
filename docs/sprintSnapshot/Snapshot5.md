# Sprint 5 (28/02/2025 - 21/03/2025)


Aquest sprint ens hem enfocat en tenir establerta la web en el domini i tenir la BD ja disponible. Apart, hem millorat bastant la web fent us de les apis, tailwind css y del backend amb el php laravel (blade).


En aquest sprint teniem que fer-hi la presentació de mitad de projecte i la presentació al client juntament amb el Ismab. Es per aixó que el nostre desenvolupament en aquest sprint ha sigut principalment en desarrollar la web per una mitllor mostra. 

Les millores en aquest sprint son:

### Multimenu:
Una implementació ha sigut aquest multimenu on aportem les views d'"Herramientas" tant com plaques, bateries o inversors..."
![image](https://github.com/user-attachments/assets/10f5d474-8670-407b-960b-a337f94f1023)


### Inversors:
Com hem explicat abans, aquesta es la view d'inversors on té basicament el crud. (Encara no funciona completament, ja que queda validar les dades completament i fer-hi l'opció d'editar).
Es composa d'un modal principal on te un formulari POST per pujar-hi les dades a la BD i mostrarles en la tabla.
![image](https://github.com/user-attachments/assets/9902cdb2-5bf5-440c-8b88-0230d8e234c2)
El modal de creació també té un altre modal on es seleccionen els fabricants o és creen (També desde la BD).
![image](https://github.com/user-attachments/assets/917c4d46-e525-4505-ae34-4efdae74ed09)
Aixi quedaria la tabla després de crear un inversor. Com podem observar té també els botons de editar i eliminar, encara que només funciona el de eliminar.
![image](https://github.com/user-attachments/assets/b805d23c-ed95-40ed-8357-245fe714a56f)
El botó d'eliminar genera aquest altre modal on es valida l'eliminació de dades ficant-li el nombre del inversor.
![image](https://github.com/user-attachments/assets/dc0ccb3d-ff9c-45bd-b9eb-4bb833798b07)


### Pagina d'inici:
Aquesta es la nostra pagina d'inici terminada. Es la pagina que es mostra al accedir-hi a la web. Esta basada en la pagina de Lenium. L'objectiu es poder veure d'on prové el projecte i té l'opcions de loguejarte i registrarte. 
![image](https://github.com/user-attachments/assets/08d6911b-7248-4fa3-8fb2-32e4ce8c262b)



### Obstacles:
Hem implementat l'opció de poder-hi treure del area principal l'area dels obstacles. Ho fem generant un altre poligon que al crear-se l'hi resta la seva area al total. També tens l'opcio d'eliminarlos, pasant la seva area al area total.
![image](https://github.com/user-attachments/assets/655d18f7-d74d-4777-b0e8-718557731925)


### Numero de plaques:
Aquesta pagina ens ha costat bastant fer-la ja que es on es emmagatzeman els projectes, toman dades del formulari de dades client, del user id i del estat ("Estado") del projecte....
![image](https://github.com/user-attachments/assets/22aa8cb7-8603-499e-9a5d-64c4afb5e64e)

També té implementat un side-panel on es mostra l'informació amb més detall. Tota aquesta informacio es guarda en la BD...
![image](https://github.com/user-attachments/assets/4ed70aa3-d140-4749-81df-fefd2b5caa7c)

### Llistat de plaques
![image](https://github.com/user-attachments/assets/e2ee16fa-6377-4b02-bc80-03c172936ade)

![image](https://github.com/user-attachments/assets/c563e452-e9e8-464c-83d2-4fcff0fa779c)



