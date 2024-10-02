<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Article::factory()->count(10)->create();
        Category::factory()->count(5)->create();
        Comment::factory()->count(40)->create();
        // soccer topics only categories 70
        $categories = [
            "The evolution of football tactics",
            "The impact of VAR on the game",
            "The rise of women's football",
            "Football and its influence on culture",
            "The role of analytics in football",
            "Famous football rivalries",
            "The business side of football",
            "Youth academies and player development",
            "The importance of physical fitness in football",
            "Globalization of football",
            "The role of a captain on a football team",
            "The influence of social media on football",
            "Football and mental health",
            "The significance of club versus country",
            "Football legends and their legacies",
            "The impact of injuries on player careers",
            "Referee decisions and their controversies",
            "Football fan culture around the world",
            "The financial implications of promotion and relegation",
            "The best football stadiums in the world",
            "Sustainability in football clubs",
            "The importance of diversity in football",
            "The evolution of football kits",
            "Grassroots football and community impact",
            "Football's role in charity and social causes",
            "The psychology of penalty shootouts",
            "Iconic moments in World Cup history",
            "Football and politics",
            "The rise of esports in football",
            "The role of goalkeepers in modern football",
            "Football training methodologies",
            "The impact of global tournaments on local leagues",
            "The future of football technology",
            "The art of defending in football",
            "Famous football scandals and controversies",
            "The role of sports psychology in performance",
            "The importance of teamwork in football",
            "Football's impact on local economies",
            "Player transfers and their implications",
            "The role of sports agents in football",
            "Football and climate change",
            "Youth participation in football",
            "The future of international football competitions",
            "Crisis management in football clubs",
            "The influence of former players as coaches",
            "The significance of fan ownership in football",
            "How football can promote gender equality",
            "Cultural exchange through football",
            "The history of the FIFA World Cup",
            "The impact of injuries on team performance",
            "The role of VAR in player safety",
            "Football broadcasting and its evolution",
            "How to grow football in non-traditional markets",
            "Football and technology: wearables and data analysis",
            "The impact of player contracts on team strategy",
            "Iconic football quotes and their meanings",
            "The evolution of football rules",
            "The significance of friendly matches",
            "The role of volunteers in football events",
            "Football as a form of expression",
            "The relationship between football and education",
            "The history and future of the UEFA Champions League",
            "How to improve grassroots football infrastructure",
            "The legacy of clubs like Manchester United and FC Barcelona",
            "The impact of Lionel Messi and Cristiano Ronaldo on modern football",
            "Emerging talents in football: who to watch?",
            "The role of fan engagement in club success",
            "Analyzing the tactical styles of top coaches like Pep Guardiola and Jürgen Klopp",
            "The effect of COVID-19 on football clubs and leagues",
            "The significance of derbies, such as El Clásico and the Manchester Derby",
            "How clubs like Bayern Munich maintain dominance in their leagues",
            "The importance of local players in global football clubs",
            "Football documentaries that changed the narrative of the sport",
            "The role of technology in enhancing player performance and recovery",
        ];


        foreach ($categories as $category) {
            Category::factory()->create([
                'name' => $category,
            ]);
        }


        User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
        ]);

        User::factory()->create([
            'name' => 'santosh',
            'email' => 'santosh@gmail.com',
        ]);
    }
}
