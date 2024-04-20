#pragma once
#include <string>
#include <thread>

namespace pp
{

	const float pi = acos(-1);

	class Game
	{
		int m_width;
		int m_height;
		std::string m_capture;
		pp::Circle* m_c;
		bool* m_col;
		int m_n;
		sf::RenderWindow m_window;



	public:
		Game(int width, int height, const std::string& capture)
		{
			m_width = width;
			m_height = height;
			m_capture = capture;
		}

		void Setup(int n)
		{
			m_n = n;

			m_window.create(sf::VideoMode(m_width, m_height), m_capture);

			srand(time(0));

			m_c = new pp::Circle[m_n];
			m_col = new bool[m_n];
			std::fill(m_col, m_col + m_n, true);

			for (int i = 0; i < m_n; i++)
			{
				int r = rand() % 40 + 20;
				int x, y;
				bool collision;
				do {
					collision = false;
					x = rand() % (m_width - 2 * r) + r;
					y = rand() % (m_height - 2 * r) + r;

					// Проверяем, не пересекается ли новый шар с уже созданными
					for (int j = 0; j < i; ++j)
					{
						float dist = sqrt(pow(x - m_c[j].X(), 2) + pow(y - m_c[j].Y(), 2));
						if (dist < r + m_c[j].R())
						{
							collision = true;
							break;
						}
					}
				} while (collision);
				int v = rand() % 100 + 10;
				float alfa = rand() % 7;
				m_c[i].Setup(x, y, r, v, alfa);
				m_col[i] = true;
			}
		}

		void TouchBorder(Circle& obj)
		{
			float x = obj.X();
			float y = obj.Y();
			float r = obj.R();

			if (x + r >= m_width || x - r <= 0)
			{
				obj.Vx(-obj.Vx());
			}

			if (y + r >= m_height || y - r <= 0)
			{
				obj.Vy(-obj.Vy());
			}
		}

		void Collision(Circle& c1, Circle& c2, int i, int j)
		{
			float dist = pow(c1.X() - c2.X(), 2) + pow(c1.Y() - c2.Y(), 2);
			if (dist <= pow(c1.R() + c2.R(), 2))
			{
				if (m_col[i] && m_col[j])
				{
					m_col[i] = false;
					m_col[j] = false;

					float xm = c1.X() + (c2.X() - c1.X()) * (c1.R() / (c1.R() + c2.R()));
					float ym = c1.Y() + (c2.Y() - c1.Y()) * (c1.R() / (c1.R() + c2.R()));

					float px = c2.X() - c1.X();
					float py = c2.Y() - c1.Y();
					float len = sqrt(pow(px, 2) + pow(py, 2));
					float beta = acos((px) / len);


					if ((px > 0 && py > 0) || (px < 0 && py > 0))
						beta = -beta;


					float v1x = c1.Vx() * cos(beta) - c1.Vy() * sin(beta);
					float v1y = c1.Vx() * sin(beta) + c1.Vy() * cos(beta);
					float v2x = c2.Vx() * cos(beta) - c2.Vy() * sin(beta);
					float v2y = c2.Vx() * sin(beta) + c2.Vy() * cos(beta);


					float v1y_s = v1y;
					float v2y_s = v2y;
					float v1x_s = v2x;
					float v2x_s = v1x;


					c1.Vx(v1x_s * cos(beta) + v1y_s * sin(beta));
					c1.Vy(-v1x_s * sin(beta) + v1y_s * cos(beta));
					c2.Vx(v2x_s * cos(beta) + v2y_s * sin(beta));
					c2.Vy(-v2x_s * sin(beta) + v2y_s * cos(beta));
				}
			}
			else
			{
				m_col[i] = true;
				m_col[j] = true;
			}
		}

		void LifeCycle()
		{
			sf::Clock clock;

			while (m_window.isOpen())
			{

				sf::Event event;
				while (m_window.pollEvent(event))
				{
					if (event.type == sf::Event::Closed)
						m_window.close();
				}


				float dt = clock.getElapsedTime().asSeconds();
				clock.restart();


				for (int i = 0; i < m_n; i++)
					m_c[i].Move(dt);


				for (int i = 0; i < m_n - 1; i++)
					for (int j = i + 1; j < m_n; j++)
						Collision(m_c[i], m_c[j], i, j);

				for (int i = 0; i < m_n; i++)
					TouchBorder(m_c[i]);

				m_window.clear();
				for (int i = 0; i < m_n; i++)
					m_window.draw(m_c[i].Get());
				m_window.display();
			}
		}
	};

}