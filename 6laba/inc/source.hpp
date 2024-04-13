#pragma once
#include <SFML/Graphics.hpp>

namespace pp {
	class Circle
	{
	private:
		float m_r, m_v;
		float m_x, m_y;
		float m_alfa;
		sf::CircleShape m_shape;

	public:
		Circle() = default;

		Circle(float x, float y, float r, float v, float alfa) {
			Setup(x, y, r, v, m_alfa);
		}

		void Setup(float x, float y, float r, float v, float alfa) {
			m_x = x;
			m_y = y;
			m_r = r;
			m_v = v;
			m_alfa = alfa;
			m_shape.setOrigin(m_r, m_r);
			m_shape.setRadius(m_r);
			m_shape.setPosition(m_x, m_y);
			int color_r = rand() % 256;
			int color_g = rand() % 256;
			int color_b = rand() % 256;
			m_shape.setFillColor(sf::Color::Color(color_r, color_g, color_b, 175));
		}
		sf::CircleShape Get() 
		{
			return m_shape;
		}

		float X() { return m_x; }
		float Y() { return m_y; }
		float Alfa() { return m_alfa; }
		float R() { return m_r; };

		void Alfa(float alfa)
		{
			m_alfa = alfa;
		}

		void Move(float dt) 
		{
			float vx = m_v*cos(m_alfa);
			float vy = m_v*sin(m_alfa);
			m_x += vx * dt;
			m_y += vy * dt;
			m_shape.setPosition(m_x, m_y);
		}
	};
}

