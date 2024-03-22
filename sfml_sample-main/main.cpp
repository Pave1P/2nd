#include <SFML/Graphics.hpp>
#include <iostream>

int main()
{
    sf::RenderWindow window(sf::VideoMode(1000, 600), "SFML окно");

     const int N = 9; // Задаем количество фигур

    // Отображение N кругов
    for (int i = 0; i < N; i++)
    {
        sf::CircleShape circle(50.0f);
        circle.setFillColor(sf::Color::Green);
        circle.setPosition(i * 100, 50);
        window.draw(circle);
    }

    // Отображение N треугольников
    for (int i = 0; i < N; i++)
    {
        sf::ConvexShape triangle;
        triangle.setPointCount(3);
        triangle.setPoint(0, sf::Vector2f(0, 0));
        triangle.setPoint(1, sf::Vector2f(100, 0));
        triangle.setPoint(2, sf::Vector2f(50, 100));
        triangle.setFillColor(sf::Color::Blue);
        triangle.setPosition(i * 100, 200);
        window.draw(triangle);
    }

    // Отображение N прямоугольников
    for (int i = 0; i < N; i++)
    {
        sf::RectangleShape rectangle(sf::Vector2f(80, 120));
        rectangle.setFillColor(sf::Color::Red);
        rectangle.setPosition(i * 100, 350);
        window.draw(rectangle);
    }

    // Отображение N линий
    for (int i = 0; i < N; i++)
    {
        sf::Vertex line[]
        {
        sf::Vertex(sf::Vector2f(i * 100, 480), sf::Color::Green),
        sf::Vertex(sf::Vector2f((i + 1) * 100, 480), sf::Color::Green)
        };
        line[0].position.y = 480 - 2*i * 10; // устанавливаем высоту первой точки
        line[1].position.y = 480 - (2*i + 1) * 10; // устанавливаем высоту второй точки
        window.draw(line, 2, sf::Lines);
    }

    window.display();
    while (window.isOpen())
    {
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
                window.close();
        }
    }

    return 0;
}