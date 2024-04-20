#include <Circle.hpp>
#include <Game.hpp>
int main()
{
    pp::Game game(1000, 600, "Game");
    game.Setup(7);

    game.LifeCycle();

    return 0;
}