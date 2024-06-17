<?php

namespace App\DataFixtures;

use App\Entity\Words;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Yes there are 360 words bellow.
        $words = [
            'abandon', 'absurd', 'acumen', 'adept', 'adorn',
            'adulation', 'adventure', 'aegis', 'affluent', 'agile',
            'alchemy', 'allure', 'aloof', 'ambiguous', 'amiable', 'anomaly',
            'anticipate', 'apparition', 'aptitude', 'arcane', 'ardent',
            'artisan', 'assuage', 'astute', 'audacity', 'auspicious', 'authentic',
            'avarice', 'avid', 'awe', 'bane', 'bask', 'beacon', 'belligerent',
            'benevolent', 'bewilder', 'blithe', 'boisterous', 'bravado', 'buoyant',
            'cache', 'cajole', 'callous', 'candid', 'capricious', 'cascade',
            'catalyst', 'caustic', 'celestial', 'chaos', 'charisma', 'chivalry',
            'clandestine', 'clarity', 'climax', 'coalesce', 'coerce', 'cogent',
            'cohesive', 'commence', 'compelling', 'complacent', 'concord', 'conundrum',
            'corpulent', 'courageous', 'crestfallen', 'criterion', 'cryptic', 'cursory',
            'dank', 'debonair', 'decipher', 'defiance', 'deft', 'deference', 'defiance',
            'deft', 'deference', 'defiance', 'deft', 'deference', 'deliberate', 'delirious',
            'demure', 'depict', 'deprive', 'deride', 'desolate', 'despondent', 'deviant',
            'deviate', 'dexterous', 'diaphanous', 'diffuse', 'dilemma', 'diminish', 'discreet',
            'disparity', 'diverge', 'divine', 'dormant', 'drastic', 'eclectic', 'edifice',
            'effervescent', 'egregious', 'eloquent', 'elusive', 'emancipate', 'embezzle',
            'embolden', 'empathy', 'empirical', 'enigma', 'enrapture', 'ephemeral', 'epiphany',
            'equilibrium', 'erudite', 'esoteric', 'euphoria', 'evocative', 'exalt', 'exemplary',
            'exuberant', 'facade', 'fathom', 'fervent', 'fickle', 'flabbergast', 'flippant',
            'forsake', 'fortitude', 'furtive', 'galvanize', 'garner', 'garrulous', 'genesis',
            'germinate', 'girth', 'gossamer', 'gratuitous', 'gregarious', 'guile', 'hackneyed',
            'hapless', 'harangue', 'haughty', 'hedonist', 'hegemony', 'heresy', 'histrionic',
            'hubris', 'hybrid', 'hypocrisy', 'iconoclast', 'idiosyncrasy', 'ignite', 'imminent',
            'impetuous', 'implacable', 'impose', 'incendiary', 'incessant', 'incognito', 'indelible',
            'indifferent', 'indomitable', 'indulgent', 'inept', 'infamous', 'infiltrate', 'influx',
            'infuse', 'ingenious', 'ingrained', 'inhibit', 'innate', 'innovative', 'insatiable',
            'insidious', 'insolent', 'instigate', 'intrepid', 'inundate', 'irascible', '
            irreverent', 'jubilant', 'juxtapose', 'keen', 'kinetic', 'knell', 'labyrinth',
            'lament', 'laudable', 'lavish', 'lax', 'lethargy', 'levity', 'liberate', 'lithe',
            'lucid', 'lugubrious', 'luminous', 'magnanimous', 'malaise', 'malevolent',
            'malleable', 'manifest', 'marauder', 'meander', 'mediate', 'menagerie',
            'meticulous', 'mirth', 'misanthrope', 'misnomer', 'monotonous', 'morose',
            'myriad', 'nadir', 'nebulous', 'negligent', 'nomadic', 'noxious', 'nurture',
            'obfuscate', 'oblivion', 'obsequious', 'obtuse', 'ominous', 'omnipotent',
            'onus', 'opulent', 'ostentatious', 'ostracize', 'pacifist', 'paradox',
            'paragon', 'paramount', 'pariah', 'parochial', 'pathos', 'patronize',
            'paucity', 'pejorative', 'pensive', 'peripheral', 'permeate', 'pernicious',
            'pertinent', 'petulant', 'phenomenon', 'philanthropy', 'phobia', 'placid',
            'plausible', 'plethora', 'poignant', 'precocious', 'prelude', 'prestigious',
            'proclivity', 'profound', 'prolific', 'prominent', 'prowess', 'proximity', 'prudent',
            'pungent', 'pursuit', 'quandary', 'quell', 'querulous', 'quintessential',
            'raconteur', 'rancor', 'rapture', 'ravenous', 'reconcile', 'recourse', 'recumbent',
            'redundant', 'refute', 'relegate', 'remnant', 'renegade', 'repercussion', 'repugnant',
            'resilient', 'resolve', 'respite', 'reticent', 'revel', 'reverence', 'rhapsody', 'rife',
            'rudimentary', 'rue', 'ruminate', 'sagacious', 'salient', 'sanctuary', 'sardonic',
            'saturate', 'savant', 'scapegoat', 'scrutinize', 'secular', 'serendipity', 'shrewd',
            'solace', 'sonorous', 'sporadic', 'stagnant', 'stoic', 'strife', 'sublime', 'succinct',
            'surreptitious', 'susceptible', 'sycophant', 'taciturn', 'tantamount', 'tenuous',
            'timorous', 'tirade', 'torpor', 'transient', 'traverse', 'trepidation', 'trite',
            'ubiquitous', 'umbrage', 'unassuming', 'unilateral', 'unorthodox', 'unprecedented',
            'upbraid', 'urbane', 'vacuous', 'validate', 'vehement', 'verbose', 'versatile',
            'vex', 'viable', 'vindicate', 'virulent', 'vivacious', 'volatile', 'voracious',
            'wanderlust', 'warrant', 'whimsical', 'wistful', 'wry', 'zeal', 'zenith'

        ];

        foreach ($words as $word) {
            $entity = new Words();
            $entity->setWord($word);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
