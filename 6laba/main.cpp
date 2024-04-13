#include <SFML/Graphics.hpp>
#include "source.hpp"
#include "Game.hpp"

int main()
{
    pp::Game game(1100, 1000, "Game");
    if (!game.Setup(5)) {
        return -1;
    }

    game.Life();

    return 0;
}