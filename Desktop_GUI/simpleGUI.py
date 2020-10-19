# création d'une fenêtre et ajout d'un texte, quelques widgets basics : https://tkdocs.com/tutorial/widgets.html
import tkinter as tk
import os 
url = ""

def launchPHP(url):
    """Fonction permettant de lancer le fichier test.php en ligne de commande (nécessite d'avoir php dans le path) """
    table = [url[i:i+40] for i in range(0, len(url), 40)]
    # on sépare l'url tous les 40 caractères en plusieurs arguments car depuis le cmd un argument est limité à 43 chars
    commande = 'cd webScraping && php execScrap.php '
    for i in range(len(table)):
        commande += ' '+table[i]
        print(table[i])
    os.system(commande)
    print (url)

def createWindow():
    """Fonction principale contenant la création de la fenêtre et ses intéractions """
    window = tk.Tk()
    greeting = tk.Label(text="Bienvenu, entrez l'url d'un profil pour lequel vous soihaitez récupérer les données.",
        foreground="blue"  # Set the text color to white
        )
    greeting.pack()
    label = tk.Label(text="URL")
    entry = tk.Entry(fg="black", bg="white", width=50)
    label.pack()
    entry.pack()
    button = tk.Button(
        text="Executer le scraping",
        width=25,
        height=5,
        bg="grey",
        fg="yellow",
        command = lambda: launchPHP(entry.get())
    )
    button.pack()
    window.mainloop()

#code principal executé lors de l'appel du fichier python
createWindow()