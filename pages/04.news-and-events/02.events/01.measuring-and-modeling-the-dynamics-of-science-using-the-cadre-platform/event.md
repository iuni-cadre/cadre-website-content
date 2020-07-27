---
title: 'Fellows Webinar: All quiet on the endless frontier? Characterizing the changing nature of innovation in science and technology'
date: '22-07-2020 15:00'
date_to: '22-07-2020 16:00'
---

Our fellowship team will discuss the research they developed using CADRE, including creating novel measures of scientific influence and novel unsupervised machine learning techniques for author-name disambiguation.

===

**When:** July 22, 3 p.m. ET  
**Where:** Online  
**Livestream link:** [Register in advance for this meeting](https://iu.zoom.us/meeting/register/tJAoc-6upz4tHt07zv7k8Z7VQT6QnXfywtRb). After registering, you will receive a confirmation email containing information about joining the meeting.

**About the research:** This research team wants to better characterize scientific influence of papers, typically measured by how many times papers are cited, by distinguishing between papers that destabilize existing knowledge with novel concepts and papers that consolidate existing knowledge.

In a separate but closely related aim, the researchers also plan to create a novel unsupervised machine learning technique for author-name disambiguation by pulling abstract, title, and citation data from WoS and MAG. For both aims, the CADRE platform will provide essential infrastructure in terms of large-scale data storage and high performance computational resources.

**Abstract (abbreviated):** We propose to leverage the unique availability of data and computing resources made available through the CADRE platform in pursuit of two distinct but complementary aims (1) developing novel measures of scientific influence and (2) developing novel unsupervised machine learning techniques for author-name disambiguation.

Within this context, we propose to leverage the CADRE platform in the service of two aims.

First, we propose to develop a variation on the CD index that uses text to characterize the extent to which a focal work consolidates or destabilizes the status quo. In particular, a limitation of Funk and Owen-Smith’s index is that it relies on citations as a proxy for the use of ideas. Although citations capture valuable information, they are a noisy indicator. Citation practices are vary across fields and across time. Researchers also often cite works without deeply engaging with them. And as Merton (1968) observed, the most influential ideas become “obliterated by incorporation,” meaning that they become so widely accepted that they are no longer explicitly cited. In general, our plan is to use text (e.g., abstracts, titles) to quantify the extent to which novel concepts (i.e., new words or phrases appearing in a focal paper) draw attention to or away from the other concepts with which they initially co-occur. More concretely, we are currently exploring several app! roaches to implementing this measure, using word embeddings or an extension of the Gerrish and Blei’s (2010) document influence model within the topic modeling literature.

Second, we propose to develop and implement a novel unsupervised machine learning approach for author-name disambiguation. As mentioned above, researchers continue to produce conflicting findings in several areas of the emerging field of science, particularly on questions surrounding team collaboration (e.g., across gender or disciplinary lines). Critical to any effort to resolve such questions is the ability to accurately link bibliography records to particular authors.

There is no shortage of approaches to author name disambiguation within the literature (Hussain and Sohail, 2017). Many of the best-performing disambiguation methods rely on supervised learning models that take in vectorized information about an author and their work and learns a disambiguating map between each author and a subset of the works within the dataset. By definition, these supervised methods require a large set of correctly-labeled training data that is decorated with vectorizable auxiliary information (author biographies, affiliation, paper text, keywords). In practice, datasets like these are rare (Müller et al., 2017).

Unsupervised approaches to author name disambiguation are more general and do not rely on a training set. There are numerous works which make use of highly specific information within the dataset like author biographical information, institutional information, or keywords extracted from their work, to increase the discriminative ability amongst samples and create more accurate partitions. However, this presupposition of auxiliary information limits the transferability of these models across datasets. In Zhang et al. (2017), the authors limit themselves to an anonymized disambiguation environment wherein no auxiliary information is available. This anonymized environment includes the minimal amount of information to define the author name disambiguation task, namely a set of authors, a set of works and a relation between the two sets, and thus is general enough to be used within any database of authored works.   

Clearly this anonymized environment is extreme in its limitation of auxiliary information, and many datasets wherein one could perform name disambiguation contain auxiliary information which would be beneficial to include in the disambiguation process. The question then becomes: how do we extend this minimal-assumption, relational-embedding model to allow for the general inclusion of additional vectorizable information where available?

We hypothesize that the inclusion of auxiliary information into this relational embedding framework can be accomplished by augmenting the embedding process itself. Many network embedding techniques are founded on the idea that the vector representation of a node should be similar (in direction) to those in its network neighborhood. By infusing auxiliary information into the network’s relational structure and the definition of network neighborhoods, the resulting document embeddings are likely to produce greater separation between documents that are authored by different people. For example, the relations between authors can be decorated with a context through which that co-authorship exists, via the number of authors on the paper, keywords of the paper, or a vectorization of the paper itself. This context may then be used to determine neighborhood sampling procedures or can be included as additional latent information in the graph embedding process.

**[Read more about the researchers here.](https://cadre.iu.edu/fellows/measuring-and-modeling-the-dynamics-of-science-using-the-cadre-platform)**