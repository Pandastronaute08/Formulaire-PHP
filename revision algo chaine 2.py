"""
fonction nb_occurences(chaine,carac)
Debut
 compteur : entier
 i : 0
 Pour i allant de 0 à taille(chaine) -1
  Si chaine[i] = carac alors
   compteur <- compteur +1
  fin Si
 fin pour
retourner compteur
"""
def nb_occurences_car(string,carac) :

    compteur = 0

    for i in range(0, len(string)):
        if str.upper(string[i]) == str.upper(carac) :
            compteur = compteur + 1

    return compteur

def nb_occurences_all(string):
    tab = []
    couple = [""]*2

    for i in range(0, len(string)):
        if string[i] = 