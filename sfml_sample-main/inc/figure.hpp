#include <SFML/Graphics.hpp>

class Shapes
{
public:
    Shapes();
    void drawShapes(sf::RenderWindow& window);

private:
    const int N = 10;

    sf::CircleShape circles[10];
    sf::ConvexShape triangles[10];
    sf::RectangleShape rectangles[10];
    sf::Vertex lines[10 * 2];
};

Shapes::Shapes()
{
    // Ñîçäàíèå êðóãîâ
    for (int i = 0; i < N; i++)
    {
        circles[i].setRadius(50.f);
        circles[i].setFillColor(sf::Color::Red);
        circles[i].setPosition(i * 100, 50);
    }


    // Ñîçäàíèå òðåóãîëüíèêîâ
    for (int i = 0; i < N; i++)
    {
        triangles[i].setPointCount(3);
        triangles[i].setPoint(0, sf::Vector2f(0, 0));
        triangles[i].setPoint(1, sf::Vector2f(100, 0));
        triangles[i].setPoint(2, sf::Vector2f(50, 100));
        triangles[i].setFillColor(sf::Color::Green);
        triangles[i].setPosition(i * 100, 200);
    }

    // Ñîçäàíèå ïðÿìîóãîëüíèêîâ
    for (int i = 0; i < N; i++)
    {
        rectangles[i].setSize(sf::Vector2f(80, 120));
        rectangles[i].setFillColor(sf::Color::Blue);
        rectangles[i].setPosition(i * 100, 350);
    }

    // Ñîçäàíèå ëèíèé
    for (int i = 0; i < N; i++)
    {
        lines[i * 2].position = sf::Vector2f(i * 100, 500);
        lines[i * 2 + 1].position = sf::Vector2f((i + 1) * 100, 500);
        lines[i * 2].color = sf::Color::Yellow;
        lines[i * 2 + 1].color = sf::Color::Yellow;
    }
}

void Shapes::drawShapes(sf::RenderWindow& window)
{
    // Îòîáðàæåíèå âñåõ ôèãóð
    for (int i = 0; i < N; i++)
    {
        window.draw(circles[i]);
        window.draw(triangles[i]);
        window.draw(rectangles[i]);
        window.draw(&lines[i * 2], 2, sf::Lines);
    }
}