#include <iostream>﻿
#include "figure.hpp"
#include <SFML/Graphics.hpp>


int main()
{
    sf::RenderWindow window(sf::VideoMode(1200, 800), "SFML Shapes");
    Shapes shapes;
    while (window.isOpen())
    {
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
                window.close();
        }

        window.clear();
        shapes.drawShapes(window);
        window.display();
    }

    return 0;
}