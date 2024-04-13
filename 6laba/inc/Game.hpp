#pragma once
#include <SFML/Graphics.hpp>
#include <string>
#include <iostream>
#include <thread>
#include <Ship.hpp>

namespace pp {

	const float pi = acos(-1);
	class Game {

	private:
		int m_width;
		int m_height;
		std::string m_capture;
		pp::Circle* m_c;
		int m_n;
		sf::RenderWindow m_window;
		sf::Texture m_TextureBackground;
		sf::Sprite m_SpriteBackground;
		Ship m_Ship;

	public:
		Game(int width, int height, const std::string& capture) {
			m_width = width;
			m_height = height;
			m_capture = capture;
		}

		bool Setup(int n) {
			m_n = n;
			//Создание окна
			m_window.create(sf::VideoMode(m_width, m_height), m_capture);
			//Текстура
			if (!m_TextureBackground.loadFromFile("assets\\race.png")) {
				std::cout << "Error while loading race.jpg";
				return false;
			}
			m_SpriteBackground.setTexture(m_TextureBackground);
			//Создание корабля игрока
			if (!m_Ship.Setup(100, 100)) {
				return false;
			}
			srand(time(0));

			m_c = new pp::Circle[m_n];
			
			for (int i = 0; i < m_n; i++) {
				int r = rand() % 100 + 1;
				int x = rand() % (1000 - 2*r) + r;
				int y = rand() % (600 - 2*r) + r;
				int v = rand() % 50 + 10;
				float alfa = rand() % 7;
				m_c[i].Setup(x, y, r, v, alfa);
			}
		}

		void TouchBorder(Circle& obj) 
		{
			float x = obj.X();
			float y = obj.Y();
			float r = obj.R();

			if (x + r >= m_width || x - r <= 0)
			{
				obj.Alfa(pi - obj.Alfa());
			}

			if (y + r >= m_height || y - r <= 0)
			{
				obj.Alfa(2 * pi - obj.Alfa());
			}
		}


		void Life()
		{
			sf::Clock clock;
			while (m_window.isOpen())
			{
				//События
				sf::Event event;
				while (m_window.pollEvent(event))
				{
					if (event.type == sf::Event::Closed) {
						m_window.close();
					}
				}
				//Обработка клавиатуры
				if (sf::Keyboard::isKeyPressed(sf::Keyboard::Up)) {
					m_Ship.SetVelocity(0.001);
				}
				if (sf::Keyboard::isKeyPressed(sf::Keyboard::Down)) {
					m_Ship.SetVelocity(-0.001);
				}
				if (sf::Keyboard::isKeyPressed(sf::Keyboard::Left)) {
					m_Ship.Rotate(-0.1);
				}
				if (sf::Keyboard::isKeyPressed(sf::Keyboard::Right)) {
					m_Ship.Rotate(0.1);
				}

				//std::this_thread::sleep_for(std::chrono::milliseconds(1000)); // Задержка
				//Логика
				float dt = clock.getElapsedTime().asSeconds();
				clock.restart();
				//Перемещение шарика
				for (int i = 0; i < m_n; i++) {
					m_c[i].Move(dt);
				}
				for (int i = 0; i < m_n; i++) {
					TouchBorder(m_c[i]);
				}
				//Перемещение корабля
				m_Ship.Move();
				//Отображение
				m_window.clear();
				m_window.draw(m_SpriteBackground);
				m_window.draw(m_Ship.Get());
				for (int i = 0; i < m_n; i++) {
					m_window.draw(m_c[i].Get());
				}
				m_window.display();
			}
		}

		~Game()
		{
			delete[] m_c;
		}
	};
}