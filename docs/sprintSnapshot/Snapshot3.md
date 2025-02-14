# Sprint 3 (20/01/2025 - 14/02/2025)
**Nota:** En aquest snapshot, la majoria de les funcions implementades no tenen un funcionament correcte, ja que ens faltaria activar la facturació de les APIs.

#### Creació marcadors
Hem implementat un mapa mitjançant l'API de Google amb el qual pots crear marcador fent un clic al mapa  guardant les coordenades i dades de l'edifici per posteriorment poder treballar amb ell.
![image](https://github.com/user-attachments/assets/8f42e56c-2ab9-47ca-8638-cac2de168ddd)

#### Busqueda mitjançant l'adreça/autocomplete
Gràcies a l'API de places de Google fem ús d'un buscador en el qual tu ingresses una direcció la qual te l'autocompleta oferir-te opcions similars a la teva cerca a més a més de reubicar el mapa a l'adreça introduïda.
![image](https://github.com/user-attachments/assets/ff2f3c6a-3ea2-4ac9-8240-527c6ba197e2)

#### Canvi de vista del mapa
Hem implementat dos butons els cuals canvien la vista del mapa de roadmap a satel·lit, la primera vista serveix principalment per facilitar la direcció on es produiria la instalació i la segona, per trobar amb mes facilitat la taulada exacte, on es produiria la mateixa instalacoió.
![image](https://github.com/user-attachments/assets/e5f2c6fd-dbf2-4585-8d0a-fa3871da9f4d)

#### Mesurar façanes
Hem estat buscant la manera d'implementar aquesta funció a l'aplicació, i hem trobat dues maneres de fer-ho. La primera és mitjançant WebXR, però després de diverses proves no ens semblava del tot funcional, ja que depenia molt del dispositiu amb el qual s'executés, pel fet que es necessiten uns requisits mínims. L'altre és amb Open CV, que el problema d'aquesta opció és que necessitem un objecte per agafar-lo com a referència, ja que la imatge no té prou informació per fer-hi els càlculs.
![image](https://github.com/user-attachments/assets/9d508b46-fb35-4691-a9a0-c127609c788c)
