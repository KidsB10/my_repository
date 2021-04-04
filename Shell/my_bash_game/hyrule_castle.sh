#!/bin/bash                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       

F_number=1
first_line=0
compteur=1
rougefonce='\e[0;31m'
vertfonce='\e[0;32m'
atk=Attack
hp=Heal
neutre='\e[0;m'
hp_link=60
hp_bokoblin=30
hp_ganon=150

Stats_enemies() {
    echo -e "${rougefonce}Bokoblin"
    echo "HP: $hp_bokoblin/30"
}

Stats_player() {
    echo -e "${vertfonce}Link"
    echo "HP: $hp_link/60"
}

Stats_bosses() {
     echo -e "${rougefonce}Ganon"
    echo "HP: $hp_ganon/150"
}

# Fonction rafraichissement #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
slcl() {
    sleep 0.75
    clear
}

# Fonction boucle de combats #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
Floor() {
    while [[ $F_number -lt 10 ]]; do
    while [[ $hp_link -ne 0 ]] && [[ $hp_bokoblin -ne 0 ]]; do
        slcl
        Display
            read -r input

            if [[ $input == "attack" ]]; then
        echo "You attacked and dealt 15 damages!"
        hp_bokoblin=$((hp_bokoblin-15))
        sleep 0.75
        echo "Bokoblin attacked and dealt 5 damages!"
        hp_link=$((hp_link-5))
            fi
            if [[ $input = "heal" ]]; then
        echo "You have recovered 30 health"
        hp_link=$((hp_link+30))
        echo "Bokoblin attacked and dealt 5 damages!"
        hp_link=$((hp_link-5))
        if [[ $hp_link -gt 60 ]]; then
                hp_link=60
                echo "You are full life"
                sleep 0.75
                hp_link=$((hp_link-5))
        fi
        fi
            if [[ $hp_bokoblin -eq 0 ]]; then
        sleep 0.75
        echo "The Bokoblin died"
        hp_link=$((hp_link+5))
            fi
    done
    F_number=$((F_number+1))
    hp_bokoblin=$((hp_bokoblin+30))
    done
}

# Fonction combat final #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
Final_room() {
    while [[ $F_number -eq 10 ]]; do
    while [[ $hp_link -ne 0 ]] && [[ $hp_ganon -ne 0 ]]; do
        slcl
        Display_boss
        read -r input

        if [[ $input == "attack" ]]; then
        echo "You attacked and dealt 15 damages!"
        hp_ganon=$((hp_ganon-15))
        sleep 0.75
        echo "Ganon attacked and dealt 20 damages!"
        hp_link=$((hp_link-20))
            fi
        if [[ $input == "heal" ]]; then
        echo "You have recovered 30 health"
        hp_link=$((hp_link+30))
        sleep 0.75
        echo "Ganon attacked and dealt 20 damages!"
        hp_link=$((hp_link-20))
        fi
        if [[ $hp_link -gt 60 ]]; then
                hp_link=60
                echo "You are full life"
                sleep 0.75
                hp_link=$((hp_link-20))
        fi
        if [[ $hp_ganon -eq 0 ]]; then
        sleep 0.75
        echo "Ganon died"
        hp_link=$((hp_link+20))
        fi
    done
    done
}

# Fonction affichage général boucle de combats                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
Display() {
    echo "========== FIGHT $F_number =========="
    Stats_enemies
    echo " "
    Stats_player
    echo -e "${neutre}"
    echo "---Options---"
    echo "1. Attack   2. Heal"
    echo " "
    echo -e "${neutre}"
}

# Fonction affichage général combat final #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
Display_boss() {
    echo "========== FIGHT $F_number =========="
    Stats_bosses
    echo " "
    Stats_player
    echo -e "${neutre}"
    echo "---Options---"
    echo "1. Attack   2. Heal"
    echo " "
    echo -e "${neutre}"
}

# Fonction sélection pour pouvoir jouer ou non #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
Answer() {

    while [[ $input != "yes" ]] && [[ $input != "no" ]]; do
    read -r input
    if [[ $input = yes ]]; then
        echo "let's beat Ganon once and for all"
        slcl
        elif [[ $input = no ]]; then
        exit
        else
        echo "Choose an answer with yes or no"
        fi
    done

}

echo "Do you want to enter in the Hyrule Castle"

Answer

Floor

Final_room